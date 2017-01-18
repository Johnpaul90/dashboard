/**
 * Created by JP on 12/8/2016.
 */

function createList(){
    var s;

    s = "<ul>"
        + "<li>Living in Bondage</li>"
        + "<li>Champagne</li>"
        + "<li>The way the cookies crumble!</li>"
        + "<li>Game of Thrones</li>"
        + "</ul>"

    movies = document.getElementById('movies');
    movies.innerHTML =s;
}