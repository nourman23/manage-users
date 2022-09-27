let btn = document.getElementById("signLinkBtn");

btn.addEventListener("click", function (e) {
  e.preventDefault();

  let email = document.getElementById("email").value;
  let fullName = document.getElementById("name").value;
  let password = document.getElementById("pass").value;
  let cPassword = document.getElementById("conPass").value;
  let mobile = document.getElementById("phone").value;
  let birthday = document.getElementById("bDate").value;
  let image = document.getElementById("image").value;
  console.log(image);

  // check if email valid
  const emailValid = Validation.EmailValidation(email);
  // check if user name valid
  const usernameValid = Validation.NameValidation(fullName);
  // check if password match
  const matchPassword = Validation.PasswordValidation(password, cPassword);
  const mobileValidation = Validation.mobileValidation(mobile);
  const dateValidation = Validation.calculateRemainTime(birthday);

  const cc= Validation.MatchPassword(password, cPassword);
  console.log( mobileValidation );
  console.log("pass vs cPass  "+matchPassword);
  console.log("match ? "+cc);

    if(emailValid &&usernameValid &&matchPassword  && mobileValidation &&dateValidation){


  fetch("http://localhost/task/signup.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body: `email=${email}&password=${password}&fullName=${fullName}&mobile=${mobile}&birthday=${birthday}&image=${image}`,
  })
    .then((waad) => waad.text())
    .then((res) => console.log(res)); //document.getElementById("result").innerHTML = res)

 
    window.location.href='welcome.php?email='+email;
    }

    
});

class Validation {
  static EmailValidation(email) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
      return true;
    }
    alert("inValid email ");
    return false;
  }



  static NameValidation(name) {
    let strname = name.split(" ");
    console.log(strname);
    if (/^[a-zA-Z\s]*$/.test(name) && name != "" && strname.length > 3) {
      return true;
    }


     return (false)
  }
  //"^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
  static PasswordValidation(password, confirmPassword) {
    ///^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/
    if (/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/.test(password)) {
      return true && Validation.MatchPassword(password, confirmPassword);
    }

    return false;
  }

  static MatchPassword(password, confirmPassword) {
    if (
      password == confirmPassword &&
      password != "" &&
      confirmPassword != ""
    ) {
        alert(confirmPassword);
      return true;
    }
    
    return false;
  }

  static mobileValidation(mobile) {
   if (/^(\+\d{1,3}[- ]?)?\d{14}$/.test(mobile)) {
      return true;
    }

    return false;
  }

  
  static calculateRemainTime(dateAsString) {
    let date1 = new Date();
    let date2 = new Date(dateAsString);
    let time = date1.getTime() - date2.getTime();
    let days = time / (1000 * 3600 * 24);
    return Math.floor(Math.abs(days)) > 5840;
  }
}