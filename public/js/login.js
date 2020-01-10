const loginCircle = document.querySelector(".login-circle");

const login = document.querySelector(".login-bg-img");

loginCircle.onmouseover = () => {
	login.style.filter = "blur(8px)";
	login.style.transition = '0.25s ease-in-out';
};

loginCircle.onmouseout = () => {
	login.style.filter = "none";
};