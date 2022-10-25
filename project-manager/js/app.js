
const loginSection = document.querySelector('.login');
const loginPopup = loginSection.querySelector('.popup');
const loginForm = loginSection.querySelector('.login-form');


// when the popup arrow id clicked
loginPopup.querySelector('.fas').addEventListener('click', function() {
    loginPopup.classList.add('fade');
    setTimeout(() => {
        loginForm.style.display = 'block';
        setTimeout(() => {
            loginForm.classList.add('show');
        }, 100);
    }, 500);
});


// when the form submits
loginForm.addEventListener('submit', sendData);

function sendData(e) {
    e.preventDefault();
    let date = new Date();
    const formData = new FormData(e.target);

    const data = {
        name: formData.get('project-name'),
        totalSet: formData.get('total-set'),
        totalAchieved: formData.get('total-achieved'),
        participants: formData.get('participants'),
        milestone: formData.get('milestone'),
        details: formData.get('milestone-details'),
        image: formData.get('image').name,
        updated: `${date.getDate()}/${date.getMonth()}/${date.getFullYear()}`
    }

    const data1 = {
        milestone: formData.get('milestone'),
        details: formData.get('milestone-details'),
    }

    saveData(data,data1);
    // redirect
    // window.location.href = `${window.location.href}overview.html`;
}


function saveData(data,data1) {
    if (localStorage.getItem('project-data') === null) {
        localStorage.setItem('project-data', JSON.stringify(data));

    } else {
        const projectData = JSON.parse(localStorage.getItem('project-data'));
        const projectData1 = JSON.parse(localStorage.getItem('project-data'));
        if (!sameProject(projectData, data)) {
            localStorage.setItem('project-data', JSON.stringify(data));
            console.log("We are here")
            fetch('http://127.0.0.1:8000/api/project/update',{method:'POST',body:JSON.stringify(data1),mode:'no-cors'})
            .then(response => response.json())
            .then(data => {
                console.log(data)
            })
            

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