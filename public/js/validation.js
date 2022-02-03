const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const nameInput = form.querySelector('input[name="name"]');
const surnameInput = form.querySelector('input[name="surname"]');
const loginInput = form.querySelector('input[name="login"]');
const passwordInput = form.querySelector('input[name="password"]');
const repeatedPasswordInput = form.querySelector('input[name="repeatPassword"]');
const submitButton = form.querySelector("button");

function isEmail(email)
{
    return /\S+@\S+\.\S+/.test(email);
}

function notEmpty(string)
{
    return string.length>0;
}

function isLogin(string)
{
    return string.length>=3 && string.length<=254;
}

function isPassword(password)
{
    return password.length >= 8
}

function arePasswordsSame(password, password2)
{
    return password === password2;
}

function showValidation(element, condition)
{
    !condition ? element.classList.add('invalid-input') : element.classList.remove('invalid-input');
    element = element.nextElementSibling;
    !condition ? element.classList.remove('hide') : element.classList.add('hide');
}

function validateEmail()
{
    setTimeout(
        function ()
        {
            showValidation(emailInput, isEmail(emailInput.value));
        },
        1000
    );
}

function validatePassword() {
    setTimeout(
        function ()
        {
            showValidation(passwordInput, isPassword(passwordInput.value));
            const condition = arePasswordsSame(passwordInput.value, repeatedPasswordInput.value);
            showValidation(repeatedPasswordInput, condition);
        },
        1000
    );
}

function validatePasswordRepeat() {
    setTimeout(
        function ()
        {
            const condition = arePasswordsSame(passwordInput.value, repeatedPasswordInput.value);
            showValidation(repeatedPasswordInput, condition);
        },
        1000
    );
}

function validateName()
{
    setTimeout(
        function ()
        {
            showValidation(nameInput, notEmpty(nameInput.value));
        },
        1000
    );
}

function validateSurname()
{
    setTimeout(
        function ()
        {
            showValidation(surnameInput, notEmpty(surnameInput.value));
        },
        1000
    );
}

function validateLogin()
{
    setTimeout(
        function ()
        {
            showValidation(loginInput, isLogin(loginInput.value));
        },
        1000
    );
}

function handleSubmit()
{
    let correct =
        isEmail(emailInput.value) &&
        isPassword(passwordInput.value) &&
        arePasswordsSame(passwordInput.value, repeatedPasswordInput.value) &&
        notEmpty(nameInput.value) &&
        notEmpty(surnameInput.value) &&
        isLogin(loginInput.value);

    if(correct){
        form.submit();
    }
    else{
        validateEmail();
        validateLogin();
        validateName();
        validateSurname();
        validatePassword();
        validatePasswordRepeat();
        alert("You need to correct all fields");
    }
}

emailInput.oninput = validateEmail;
nameInput.oninput = validateName;
surnameInput.oninput = validateSurname;
loginInput.oninput = validateLogin;
passwordInput.oninput = validatePassword;
repeatedPasswordInput.oninput = validatePasswordRepeat;
submitButton.addEventListener('click',handleSubmit);