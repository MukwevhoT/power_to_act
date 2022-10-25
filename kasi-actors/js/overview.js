window.addEventListener('load', function(e) {
    const data = getData();
    updateUI(data);
});


function getData() {
    const projectData = JSON.parse(localStorage.getItem('project-data'));
    return projectData;
}


function updateUI(data) {
    // console.log(data);
    const nameContainer = document.querySelector('#project-name');
    const achievedContainer = document.querySelector('#number-achieved')
    const participantsContainer = document.querySelector('#number-participants');
    const reviewContainer = document.querySelector('#number-for-review');
    const missedContainer = document.querySelector('#missed-number');
    const lastUpdatedContainer = document.querySelector('#last-updated');

    // inject
    nameContainer.textContent = data.name;
    achievedContainer.textContent = data.totalAchieved
    participantsContainer.textContent = data.participants;
    reviewContainer.textContent = (data.totalSet - data.totalAchieved);
    missedContainer.textContent = (data.totalSet - data.totalAchieved);
    lastUpdatedContainer.textContent = data.updated;

    // progress bar
    const progress = document.querySelector('#progress-bar');
    for (let i = 0; i < data.totalSet; i++) {
        progress.innerHTML += '<div></div>'
    }

    // color setting
    if (Number(achievedContainer.textContent) > 0) {
        achievedContainer.parentElement.classList.add('good')
        achievedContainer.parentElement.classList.remove('bad')

    } else {
        achievedContainer.parentElement.classList.add('bad')
        achievedContainer.parentElement.classList.remove('good')
    }

    if (Number(participantsContainer.textContent) > 5) {
        participantsContainer.parentElement.classList.add('good')
        participantsContainer.parentElement.classList.remove('bad')

    } else {
        participantsContainer.parentElement.classList.add('bad')
        participantsContainer.parentElement.classList.remove('good')
    }

    if (Number(reviewContainer.textContent) == 0) {
        reviewContainer.parentElement.classList.add('good');
        reviewContainer.parentElement.classList.remove('bad');
    }else {
        reviewContainer.parentElement.classList.add('bad');
        reviewContainer.parentElement.classList.remove('good');
    }

    let progressPoints = document.querySelectorAll('#progress-bar div');
    for (let i = 0; i < Number(achievedContainer.textContent); i++) {
        progressPoints[i].classList.add('good')
    }
}
