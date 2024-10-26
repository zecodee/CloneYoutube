const container = document.getElementById('container');
const register_btn = document.getElementById('register');
const login_btn = document.getElementById('login');

document.addEventListener('DOMContentLoaded', () => {
    const isRegisterActive = localStorage.getItem('isRegisterActive');

    if (isRegisterActive === 'true') {
        container.classList.add('active');
    }
});

register_btn.addEventListener('click', () => {
    container.classList.add('active');
    localStorage.setItem('isRegisterActive', 'true');
});

login_btn.addEventListener('click', () => {
    container.classList.remove('active');
    localStorage.removeItem('isRegisterActive');
});
