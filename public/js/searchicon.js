const searchIcon = document.getElementById('search-icon');
const searchBar = document.getElementById('search-bar');
const searchContainer = document.querySelector('.search-container');

searchIcon.addEventListener('click', () => {
    searchBar.classList.toggle('active');
    searchContainer.classList.toggle('active');

    if (searchBar.classList.contains('active')) {
        const inputField = searchBar.querySelector('input');
        inputField.focus();
    }
});
