//validator
function hasRepeatedLetters(value) {
    if (!value) {
        return false;
    }
    const regex = /([a-zA-Z])\1{2}/;
    return regex.test(value);
}
function hasRepeatedLettersInSuffix(value) {
    if (!value) {
        return false;
    }
    const regex = /([a-zA-Z])\1{3}/;
    return regex.test(value);
}
function validateIfCapitalize(value) {
    if (!value) {
        return true;
    }
    return value === value
        .toLowerCase()
        .split(' ')
        .map(s => s.charAt(0).toUpperCase() + s.substring(1)).join(' ');
}
function validateIfCapitalizeInSuffix(value) {
    if (!value) {
        return true;
    }
    const regex = /([a-zA-Z])/;
    return regex.test(value);
}
function containNumbers(value) {
    var regex = /[0-9]+/;
    if (regex.test(value)) {
        return true;
    }
    return false;
}
function containSpecialCharacters(value) {
    var regex = /[!@'';:#$%^&*()\-\/+<>.,?\/\\\|\[\]\{\}]+/;
    if (regex.test(value)) {
        return true
    }
    return false;
}
function containsLetters(value) {
    if (!value) {
        return false;
    }
    if (!/^[0-9]+$/.test(value)) {
        return true
    }
    return false;
}
function validatePhilippineMobileNumber(mobileNumber) {
    if (!mobileNumber) {
        return true;
    }
    if (mobileNumber.length < 11) {
        return false
    }
    var pattern1 = /^(09\d{9})$/;
    var pattern2 = /^(\+639)?\d{9}$/;
    if (!pattern1.test(mobileNumber) && !pattern2.test(mobileNumber)) {
        return false
    }
    return true;
}
function isValidAddress(value) {
    if (!value) {
        return true;
    }
    var pattern = /^[a-zA-Z0-9,.\-\s]+$/;
    return pattern.test(value);
}
/*
    #TODO no words nor letter but if contains 1 space at the beginning will restrict
*/
function validateOneSpaceAtTheEnd(input) {
    if (!input) {
        return false;
    }
    var pattern = /^([0-9a-zA-Z,.-]+ )*$/;
    return pattern.test(input);
}
function validateOneSpacePerWord(input) {
    if (!input) {
        return true;
    }
    var pattern = /^[0-9a-zA-Z,.-]+( [0-9a-zA-Z,.-]+)*$/;
    return pattern.test(input);
}
function startInputContainSpace(input) {
    if (!input) {
        return false;
    }
    if (input === " ") {
        return true;
    }
    var pattern = /^( [0-9a-zA-Z,.-]+)*$/;
    return pattern.test(input);
}
function passwordValidation(value) {
    if (!value) {
        return true;
    }
    return /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/.test(value)
}
// function capitalizeFirstLetter(inputString) {
//     return inputString.charAt(0).toUpperCase() + inputString.slice(1);
// }
function forSuffixValidation(suffixValue) {
    //suffix
    // Allow empty suffix or valid Roman numerals, "Jr.", or "Sr."
    var validSuffixRegex = /^(M{0,3})(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$|^Jr\.$|^Sr\.$/;
    if (!validSuffixRegex.test(suffixValue)) {
        return true;
    }
    return false;
}

//validation that it will automatically restrict when you type
function capitalizeFirstLetter(inputId) {
    const inputElement = document.getElementById(inputId);
    const words = inputElement.value.split(' ');
    // const words = input.split(' ');

    for (let i = 0; i < words.length; i++) {
        if (words[i].length > 0) {
            words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
        }
    }
    inputElement.value = words.join(' ');
}
function restrictNonLetters(inputElementId) {
    var inputElement = document.getElementById(inputElementId);

    if (!inputElement) {
        console.error('Input element not found with id: ' + inputElementId);
        return;
    }

    inputElement.addEventListener('input', function (event) {
        var inputValue = event.target.value;

        // Remove any non-letter characters
        var cleanedValue = inputValue.replace(/[^A-Za-z]/g, ' ');

        // Update the input field with the cleaned value
        event.target.value = cleanedValue;

        // You can add additional validation logic here if needed
    });
}
function restrictTwoConsecutiveLetters(event, fieldName) {
    const inputElement = event.target;
    let inputValue = inputElement.value;

    // Remove more than 2 consecutive repeated letters
    inputValue = inputValue.replace(/([a-zA-Z])\1{2,}/gi, function (match, group) {
        return group + group; // Keep only 2 consecutive
    });

    // Update the input value if it was changed
    if (inputValue !== inputElement.value) {
        inputElement.value = inputValue;
    }
}
function restrictSpaceStart(event) {
    const input = event.target;
    const cursorStart = input.selectionStart;
    const cursorEnd = input.selectionEnd;

    if (input.value.charAt(0) === ' ') {
        setTimeout(() => {
            input.value = input.value.trim();
            input.setSelectionRange(cursorStart - 1, cursorEnd - 1);
        });
    }
}
function restrictDoubleSpaces(event, fieldName) {
    const inputElement = event.target;
    const inputValue = inputElement.value;

    // Replace double spaces with a single space
    const sanitizedValue = inputValue.replace(/\s{2,}/g, ' ');

    // Update the input value if it was changed
    if (sanitizedValue !== inputValue) {
        inputElement.value = sanitizedValue;
    }
}
function restrictNonNumeric(input) {
    input.value = input.value.replace(/[^0-9+]/g, '');
}
function restrictNonNumeric(input) {
    input.value = input.value.replace(/[^0-9+]/g, '');
}
function restrictSpaces(event, fieldName) {
    const inputElement = event.target;
    const inputValue = inputElement.value;

    // Remove spaces from the input value
    const sanitizedValue = inputValue.replace(/\s/g, '');

    // Update the input value if it was changed
    if (sanitizedValue !== inputValue) {
        inputElement.value = sanitizedValue;
    }
}
function preventSpace(event, inputId) {
    if (event.which === 32 && document.getElementById(inputId).selectionStart === 0) {
        event.preventDefault();
    }
}


// //validate form
document.getElementById('register-form').addEventListener('submit', async (e) => {
    //get the value that inputted
    var firstname = document.querySelector("input[name=firstname]").value;
    var middlename = document.querySelector("input[name=middlename]").value;
    var lastname = document.querySelector("input[name=lastname]").value;
    var suffix = document.querySelector("input[name=suffix]").value;
    var sex = document.querySelector("#sex").value;
    var birthdate = document.querySelector("input[name=birthdate]").value;
    var age = document.querySelector("input[name=age]").value;
    var mobilenumber = document.querySelector("input[name=mobilenum]").value;
    var email = document.querySelector("input[name=email]").value;
    var country = document.querySelector("input[name=country]").value;
    var province = document.querySelector("input[name=province]").value;
    var city = document.querySelector("input[name=city]").value;
    var purok = document.querySelector("input[name=purok]").value;
    var barangay = document.querySelector("input[name=barangay]").value;
    var zipcode = document.querySelector("input[name=zipcode]").value;
    var username = document.querySelector("input[name=username]").value;
    var password = document.querySelector("input[name=password]").value;
    var confirmpass = document.querySelector("input[name=confirmpassword]").value;
    var role = document.querySelector("#role").value;

    //if theres no any validation registered
    e.preventDefault();
    const formData = new FormData();
    formData.append('firstname', firstname);
    formData.append('middlename', middlename);
    formData.append('lastname', lastname);
    formData.append('suffix', suffix);
    formData.append('sex', sex);
    formData.append('birthdate', birthdate);
    formData.append('age', age);
    formData.append('mobilenum', mobilenumber);
    formData.append('email', email);
    formData.append('country', country);
    formData.append('province', province);
    formData.append('city', city);
    formData.append('purok', purok);
    formData.append('barangay', barangay);
    formData.append('zipcode', zipcode);
    formData.append('username', username);
    formData.append('password', password);
    formData.append('role', role);
    formData.append('confirmpassword', confirmpass);

    console.log(formData)

    const response = await fetch("/classes/Authentication.php?f=register", {
        method: "POST",
        body: formData
    });
    const data = await response.json();

    if (!data.ok && data.type === "email") {
        //display error
        document.getElementById("is-valid-email").innerHTML = data.message;
        document.getElementById("email-label").style.color = "red";
        document.getElementById("email").style.border = "1px solid red";
        document.getElementById("is-valid-username").innerHTML = "";
        document.getElementById("username-label").style.color = "";
        document.getElementById("username").style.border = "";
        return;
    } else if (!data.ok && data.type === "username") {
        //display error
        document.getElementById("is-valid-username").innerHTML = data.message;
        document.getElementById("username-label").style.color = "red";
        document.getElementById("username").style.border = "1px solid red";
        document.getElementById("is-valid-email").innerHTML = "";
        document.getElementById("email-label").style.color = "";
        document.getElementById("email").style.border = "";
        return;
    }
    document.getElementById("is-valid-username").innerHTML = "";
    document.getElementById("username-label").style.color = "";
    document.getElementById("username").style.border = "";
    document.getElementById("is-valid-email").innerHTML = "";
    document.getElementById("email-label").style.color = "";
    document.getElementById("email").style.border = "";
    document.getElementById('password-strength').innerHTML = "";
    document.querySelectorAll("input").forEach((inputFields) => {
        inputFields.value = "";
    });
})


// firstname validation
const firstname = document.getElementById('firstname');
const firstname_label = document.getElementById('firstname-label');
firstname.addEventListener("input", (e) => {
    //get the value of firstname
    preventSpace(e, 'firstname')
    capitalizeFirstLetter('firstname');
    restrictSpaceStart(e);
    restrictDoubleSpaces(e, 'firstname');
    restrictTwoConsecutiveLetters(e, 'firstname');
    restrictNonLetters('firstname');
});


// middlename validation
const middlename = document.getElementById('middlename');
const middlename_label = document.getElementById('middlename-label');
middlename.addEventListener("input", (e) => {
    capitalizeFirstLetter('middlename');
    restrictSpaceStart(e);
    restrictDoubleSpaces(e, 'middlename');
    restrictTwoConsecutiveLetters(e, 'middlename');
    restrictNonLetters('middlename');
});


// lastname validation
const lastname = document.getElementById('lastname');
const lastname_label = document.getElementById('lastname-label');
lastname.addEventListener("input", (e) => {
    capitalizeFirstLetter('lastname');
    restrictSpaceStart(e);
    restrictDoubleSpaces(e, 'lastname');
    restrictTwoConsecutiveLetters(e, 'lastname');
    restrictNonLetters('lastname');
});


// suffix validation
const suffix = document.getElementById('suffix');
const suffix_label = document.getElementById('suffix-label');
suffix.addEventListener("input", (e) => {
    var suffix_value = e.target.value;
    restrictSpaceStart(e);
    restrictDoubleSpaces(e, 'suffix');
    if (forSuffixValidation(suffix_value)) {
        suffix.setCustomValidity("Invalid Suffix (example format: Jr., Sr., I, II, III, IV...)")
        suffix_label.style.color = "red";
        suffix.style.border = "1px solid red";
    } else {
        suffix.setCustomValidity("");
        suffix_label.style.color = "";
        suffix.style.border = "";
    }
});


//birthdate validate if the user is 18 above
const startInput = document.getElementById('birthdate');
startInput.addEventListener('change', () => {
    const startDate = new Date(startInput.value);
    const today = new Date();
    const age = Math.floor((today - startDate) / (1000 * 60 * 60 * 24 * 365));
    document.getElementById('age').value = age;
    if (isNaN(age)) {
        startInput.setCustomValidity('Invalid Birthdate.');
        startInput.style.border = "1px solid red";
        document.getElementById("birthdate-label").style.color = "red";
        return;
    } else if (age < 18) {
        startInput.setCustomValidity('You must be at least 18 years old to submit this form.');
        startInput.style.border = "1px solid red";
        document.getElementById("birthdate-label").style.color = "red";
        return
    } else if (age > 100) {
        startInput.setCustomValidity('You must be at least 100 years old below to submit this form.');
    } else {
        startInput.setCustomValidity('');
        startInput.style.border = "";
        document.getElementById("birthdate-label").style.color = "";
    }
});


//mobile number validation
const mobilenumber = document.getElementById("mobilenum");
const mobilenumber_label = document.getElementById("mobilenum-label")
mobilenumber.addEventListener("input", (e) => {
    var mobilenum_value = e.target.value;
    restrictSpaceStart(e);
    restrictDoubleSpaces(e, 'mobilenum');
    restrictNonNumeric(mobilenumber);
    if (startInputContainSpace(mobilenum_value)) {
        mobilenumber.setCustomValidity("Mobile number should not start with space");
        document.getElementById('mobilenum-label').style.color = "red";
        document.getElementById('mobilenum').style.border = "1px solid red";
    } else if (validateOneSpaceAtTheEnd(mobilenum_value)) {
        mobilenumber.setCustomValidity("Mobile number should not end with space.")
        mobilenumber_label.style.color = "red";
        mobilenumber.style.border = "1px solid red";
    } else if (!validatePhilippineMobileNumber(mobilenum_value)) {
        mobilenumber.setCustomValidity("Please enter a valid Philippine mobile number. e.g +639123456789 or 09123456789");
        document.getElementById('mobilenum-label').style.color = "red";
        document.getElementById('mobilenum').style.border = "1px solid red";
    } else {
        mobilenumber.setCustomValidity("");
        document.getElementById('mobilenum-label').style.color = "";
        document.getElementById('mobilenum').style.border = "";
    }
});
mobilenumber.addEventListener('click', () => {
    mobilenumber.value = "+639";
})



// country validation
const country = document.getElementById('country');
const country_label = document.getElementById('country-label');
country.addEventListener("input", (e) => {
    capitalizeFirstLetter('country');
    restrictSpaceStart(e);
    restrictDoubleSpaces(e, 'country');
    restrictTwoConsecutiveLetters(e, 'country');
    restrictNonLetters('country');
});



// province validation
const province = document.getElementById('province');
const province_label = document.getElementById('province-label');
province.addEventListener("input", (e) => {
    capitalizeFirstLetter('province');
    restrictSpaceStart(e);
    restrictDoubleSpaces(e, 'province');
    restrictTwoConsecutiveLetters(e, 'province');
    restrictNonLetters('province');
});


// city validation
const city = document.getElementById('city');
const city_label = document.getElementById('city-label');
city.addEventListener("input", (e) => {
    capitalizeFirstLetter('city');
    restrictSpaceStart(e);
    restrictDoubleSpaces(e, 'city');
    restrictTwoConsecutiveLetters(e, 'city');
    restrictNonLetters('city');
});


// purok validation
const purok = document.getElementById('purok');
const purok_label = document.getElementById('purok-label');
purok.addEventListener("input", (e) => {
    capitalizeFirstLetter('purok');
    restrictSpaceStart(e);
    restrictDoubleSpaces(e, 'purok');
    restrictTwoConsecutiveLetters(e, 'purok');
});


// barangay validation
const barangay = document.getElementById('barangay');
const barangay_label = document.getElementById('barangay-label');
barangay.addEventListener("input", (e) => {
    capitalizeFirstLetter('barangay');
    restrictSpaceStart(e);
    restrictDoubleSpaces(e, 'barangay');
    restrictTwoConsecutiveLetters(e, 'barangay');
});

//zipcode
document.getElementById('zipcode').addEventListener("input", (e) => {
    const zipcode = document.getElementById("zipcode");
    const zipcode_label = document.getElementById("zipcode-label");
    const inputValue = e.target.value.trim();
    const zipcodeInt = parseInt(inputValue);
    if (zipcodeInt < 100 || zipcodeInt > 9811) {
        zipcode.setCustomValidity("Please enter a valid ZIP code");
        zipcode.style.border = "1px solid red";
        zipcode_label.style.color = "red";
    } else if (isNaN(inputValue)) {
        zipcode.setCustomValidity("Please enter a valid ZIP code");
        zipcode_label.style.color = "red";
        zipcode.style.border = "1px solid red";
    } else {
        zipcode.setCustomValidity("");
        zipcode_label.style.color = "";
        zipcode.style.border = "";
    }
})


//check password strength real time checker
document.getElementById('password').addEventListener('input', (e) => {
    var password = e.target.value;
    var strengthIndicator = document.getElementById('password-strength');
    document.getElementById('is-valid-password').innerHTML = "";
    var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/;
    var isStrong = regex.test(password);
    if (!password) {
        strengthIndicator.innerText = '';
        return;
    }
    if (isStrong) {
        strengthIndicator.innerText = 'Password is Strong';
        strengthIndicator.style.color = 'green';
    } else if (password.length >= 8) {
        strengthIndicator.innerText = 'Password is Medium';
        strengthIndicator.style.color = '#eeb600';
    } else {
        strengthIndicator.innerText = 'Password is Weak';
        strengthIndicator.style.color = 'red';
    }
})


//check if password match and password valid
const password = document.getElementById('password');
const password_label = document.getElementById('password-label')
const confirmPassword = document.getElementById('confirmpassword');
const confirmPassword_label = document.getElementById("confirmpassword-label")
password.addEventListener('input', (e) => {
    var password_value = e.target.value;
    if (password_value === "") {
        password_label.style.color = "";
        confirmPassword.style.border = "";
        password_label.style.color = "";
        password.style.border = "";
    } else if (!/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/.test(password_value)) {
        password.setCustomValidity("Password must contain at least one lowercase letter, one uppercase letter, one digit, one special character, and be at least 8 characters long.");
        password.style.border = "1px solid red";
        password_label.style.color = "red";
    } else if (password_value !== confirmPassword.value && confirmPassword.value !== "") {
        confirmPassword.setCustomValidity("Please make sure your passwords match.");
        document.getElementById("is-valid-confirmpassword").innerHTML = "Please make sure your passwords match.";
        password.style.border = "1px solid red";
        password_label.style.color = "red";
        confirmPassword_label.style.color = "red";
        confirmPassword.style.border = "1px solid red";
    } else {
        confirmPassword.setCustomValidity("");
        password.setCustomValidity("");
        confirmPassword_label.style.color = "";
        confirmPassword.style.border = "";
        password_label.style.color = "";
        password.style.border = "";
        document.getElementById("is-valid-confirmpassword").innerHTML = "";
    }
});
confirmPassword.addEventListener('input', (e) => {
    var confirmPassword_value = e.target.value;
    if (confirmPassword_value === "") {
        confirmPassword.setCustomValidity("");
        password_label.style.color = "";
        confirmPassword.style.border = "";
        confirmPassword_label.style.color = "";
        document.getElementById("is-valid-confirmpassword").innerHTML = "";
        password.style.border = "";
    } else if (password.value !== confirmPassword_value) {
        confirmPassword.setCustomValidity("Please make sure your passwords match.");
        document.getElementById("is-valid-confirmpassword").innerHTML = "Please make sure your passwords match.";
        password_label.style.color = "red";
        confirmPassword.style.border = "1px solid red";
        confirmPassword_label.style.color = "red";
        password.style.border = "1px solid red";
    } else {
        confirmPassword.setCustomValidity("");
        document.getElementById("is-valid-confirmpassword").innerHTML = "";
        password_label.style.color = "";
        confirmPassword.style.border = "";
        confirmPassword_label.style.color = "";
        password.style.border = "";
    }
})


//eye icon show password
document.getElementById('togglePassword').addEventListener('click', function () {
    var passwordField = document.getElementById('password');
    var type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});
document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
    var passwordField = document.getElementById('confirmpassword');
    var type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});


//check if username and email is exist
const button = document.getElementById('button');
const username = document.getElementById('username')
const username_label = document.getElementById('username-label')
username.addEventListener("input", async (e) => {
    restrictSpaces(e, 'username')
    var username_value = e.target.value;
    const response = await fetch(`/classes/Authentication.php?f=check&username=${username_value}`);
    const data = await response.json();
    if (hasRepeatedLetters(username_value)) { //validation input user
        username.setCustomValidity("Please enter a username without repeated letters.")
        username_label.style.color = "red";
        username.style.border = "1px solid red";
    } else if (username_value.includes(" ")) {
        username.setCustomValidity("Username should not contains with spaces.")
        username_label.style.color = "red";
        username.style.border = "1px solid red";
    } else if (data.ok) { //this part is if username is already exist
        username_label.style.color = "red";
        username.style.border = "1px solid red";
        button.disabled = true;
        button.style.cursor = "not-allowed";
        document.getElementById('is-valid-username').innerHTML = data.message;
    } else {
        username.setCustomValidity("");
        username_label.style.color = "";
        username.style.border = "";
        button.style.cursor = "";
        button.disabled = false;
        document.getElementById('is-valid-username').innerHTML = "";
    }
});
const email = document.getElementById('email');
const email_label = document.getElementById('email-label');
email.addEventListener("input", async (event) => {
    restrictSpaces(event, "email")
    var email_value = event.target.value;
    const response = await fetch(`/classes/Authentication.php?f=check&email=${email_value}`);
    const data = await response.json();
    if (hasRepeatedLetters(email_value)) { //validation input user
        email.setCustomValidity("Please enter a email without repeated letters.")
        email_label.style.color = "red";
        email.style.border = "1px solid red";
    } else if (data.ok) {
        email_label.style.color = "red";
        email.style.border = "1px solid red";
        button.disabled = true;
        document.getElementById('is-valid-email').innerHTML = data.message;
    } else if (!data.ok) {
        email_label.style.color = "";
        email.style.border = "";
        button.style.cursor = "";
        button.disabled = false;
        document.getElementById('is-valid-email').innerHTML = "";
    }
});





