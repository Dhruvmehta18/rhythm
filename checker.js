function validateReg(thisform){

    var fname=thisform.fname.value;
    var lname=thisform.lname.value;
    var password=thisform.pwd.value;
    var email=thisform.email.value;
   // var chk_email=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z][2,3]$/;
    if(fname=="" || fname==null)
    {
        alert("Please enter your name");
        thisform.fname.focus();
        return false;
    }
    if(lname=="" || lname==null)
    {
        alert("Please enter your name");
        thisform.lname.focus();
        return false;
    }
    if(password=null || password=="")
    {
        alert("Please enter your password");
        thisform.pwd.focus();
        return false;
    }
    // if(validEmail(email)==false)
    // {
    //     alert("Please check your email");
    //     thisform.email.focus();
    //     return false;
    // }
    // function validEmail(email){
    //     return chk_email.test(email);
    // }
}

function isAlphabet(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return true;
    }
    return false;
}