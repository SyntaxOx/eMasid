const searchBar = document.getElementById('searchBar');
const userSearch = document.getElementById('userSearch');

searchBar.addEventListener('click', () => {
   userSearch.focus();
})