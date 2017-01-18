/**
 * Created by JP on 12/8/2016.
 */
function gametime(){
    title = document.createTextNode("Here are some things!");
    list = document.createElement("ul");

    item1 = document.createElement("li");
    text1 = document.createTextNode("Old Dan");
    item1.appendChild(text1);

    item2 = document.createElement("li");
    text2 = document.createTextNode("Chicken Wings");
    item2.appendChild(text2);

    item3 = document.createElement("li");
    text3 = document.createTextNode("Tuna");
    item3.appendChild(text3);

    list.appendChild(item1);
    list.appendChild(item2);
    list.appendChild(item3);

    theid = document.getElementById("theId");
    theId.appendChild(title);
    theId.appendChild(list)
}
