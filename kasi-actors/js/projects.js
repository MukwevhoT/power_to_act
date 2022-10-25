const form = document.querySelector('form');
const searchInput = document.querySelector('input');
const btn = document.querySelector('button');


searchInput.addEventListener('focus', function(e) {
    form.classList.add('focus');
    btn.classList.add('focus');
});

searchInput.addEventListener('blur', function(e) {
    form.classList.remove('focus');
    btn.classList.remove('focus');
})


// search feature
searchInput.addEventListener('keyup', filterProjects);
const projects = document.querySelectorAll('.project');


function filterProjects(e) {
    let searchText = searchInput.value.toLowerCase();
    hideAll(projects);
    projects.forEach(proj => {
        if (proj.dataset.tags.includes(searchText)) {
            proj.classList.remove('hide');
        }
    })
}


setInterval(() => {
    if (searchInput.value === '') {
        showAll(projects)
    }
}, 5000);


function hideAll(elements) {
    elements.forEach(el => {
        el.classList.add('hide');
    });
}

function showAll(elements) {
    elements.forEach(el => {
        el.classList.remove('hide');
    });
}