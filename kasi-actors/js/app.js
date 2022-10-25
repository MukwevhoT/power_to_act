
// const loginSection = document.querySelector('.login');
// const loginPopup = loginSection.querySelector('.popup');
// const loginForm = loginSection.querySelector('.login-form');


// when the popup arrow id clicked
// loginPopup.querySelector('.fas').addEventListener('click', function() {
//     loginPopup.classList.add('fade');
//     setTimeout(() => {
//         loginForm.style.display = 'block';
//         setTimeout(() => {
//             loginForm.classList.add('show');
//         }, 100);
//     }, 500);
// });


// when the form submits
window.addEventListener('load', sendData);

function sendData(e) {
    e.preventDefault();
    let date = new Date();
    // const formData = new FormData(e.target);

    const data = {
        name: 'chicken farm',
        totalSet: 5,
        totalAchieved: 3,
        participants: 10,
        milestone: "buy day old chicks",
        details: "purchased 100 day old chicks to start production",
        updated: `${date.getDate()}/${date.getMonth()}/${date.getFullYear()}`
    }


    saveData(data);
    // redirect
    // window.location.href = `${window.location.href}overview.html`;
}


function saveData(data) {
    if (localStorage.getItem('project-data') === null) {
        localStorage.setItem('project-data', JSON.stringify(data));

    } else {
        const projectData = JSON.parse(localStorage.getItem('project-data'));
        if (!sameProject(projectData, data)) {
            localStorage.setItem('project-data', JSON.stringify(data));

        } else {
            console.log('SAME PROJECT CANNOT CHANGE');
        }
    }
}


function sameProject(existingData, newData) {
    if (existingData.name === newData.name) {
        return true;
    }
    return false;
}