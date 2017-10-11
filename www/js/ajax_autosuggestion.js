/*
 * This script contains AJAX methods
 */
var xmlHttp;
var numNames = 0;  //total number of suggested movies names
var activeName = -1;  //movie name currently being selected
var searchBoxObj, suggestionBoxObj;

//this function creates a XMLHttpRequest object. It should work with most types of browsers.
function createXmlHttpRequestObject() {
    // create a XMLHttpRequest object compatible to most browsers
    if (window.ActiveXObject) {
        return new ActiveXObject("Microsoft.XMLHTTP");
    } else if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else {
        alert("Error creating the XMLHttpRequest object.");
        return false;
    }
}

//initial actions to take when the page load
window.onload = function () {
    //create an XMLHttpRequest object by calling the createXmlHttpRequestObject function
    xmlHttp = createXmlHttpRequestObject();

    //DOM objects
    searchBoxObj = document.getElementById('searchtextbox');
    suggestionBoxObj = document.getElementById('suggestionDiv');

    $(".row").css({'transition': '1s', 'margin-top':'50px', 'opacity': '1'});

    $("#searchbar").css({'transition': '1s', 'margin-top':'130px', 'opacity': '1'});

    $("header").css({'transition':'1s', 'margin-top': '0px', 'opacity': '1'});

    $("footer").css({'transition':'1s', 'height': '8%', 'opacity': '1'});

    $("#suggestionDiv span").css({'transition': '0.5s', 'margin-top': '0px', 'opacity':'1'});
};

window.onclick = function () {
    $("#suggestionDiv span").css({'visibility':'hidden'});
    $(suggestionBoxObj).css({'max-height': '0', 'border': 'none'});


};

//set and send XMLHttp request. The parameter is the search term
function suggest(query) {
    //if the search term is empty, clear the suggestion box.
    if (query === "") {
        suggestionBoxObj.innerHTML = "";
        return;
    }

    //proceed only if the search term isn't empty
    // open an asynchronous request to the server.
    xmlHttp.open("GET", base_url + "/" + instrument + "/suggest/" + query, true);

    //handle server's responses
    xmlHttp.onreadystatechange = function () {
        // proceed only if the transaction has completed and the transaction completed successfully
        if (xmlHttp.readyState === 4 && xmlHttp.status === 200) {
            // extract the JSON received from the server
            var names = JSON.parse(xmlHttp.responseText);
            //console.log(namesJSON);
            // display suggested names in a div block
            displayNames(names);
        }
    };

    // make the request
    xmlHttp.send(null);
}


/* This function populates the suggestion box with spans containing all the names
 * The parameter of the function is a JSON object
 * */
function displayNames(names) {
    numNames = names.length;
    //console.log(numNames);
    activeName = -1;
    if (numNames === 0) {
        //hide all suggestions
        //suggestionBoxObj.style.display = 'none';
        //suggestionBoxObj.style.maxHeight = '0';
        $(suggestionBoxObj).css({'max-height': '0'});
        $("#suggestionDiv span").css({'visibility':'hidden'});




        return false;
    }

    var divContent = "";
    //retrive the names from the JSON doc and create a new span for each name
    for (i = 0; i < names.length; i++) {
        divContent += "<span id=s_" + i + " onclick='clickName(this)'>" + names[i] + "</span>";
    }

    //display the spans in the div block
    suggestionBoxObj.innerHTML = divContent;
    //suggestionBoxObj.style.display = 'block';
    //suggestionBoxObj.style.height = 'auto';
    //suggestionBoxObj.style.opacity = '1';

    $(suggestionBoxObj).css({'max-height': '500px'});
    $("#suggestionDiv span").css({'display':'block'});

}

//This function handles keyup event. The function is called for every keystroke.
function handleKeyUp(e) {
    // get the key event for different browsers
    e = (!e) ? window.event : e;

    /* if the keystroke is not up arrow or down arrow key, 
     * call the suggest function and pass the content of the search box
     */
    if (e.keyCode !== 38 && e.keyCode !== 40) {
        $(suggestionBoxObj).css({'max-height': '500px'});
        suggest(e.target.value);
        return;
    }

    //if the up arrow key is pressed
    if (e.keyCode === 38 && activeName > 0) {
        //add code here to handle up arrow key. e.g. select the previous item
        activeNameObj.style.backgroundColor = "#FFF";
        activeNameObj.style.color = "black";
        activeName--;
        activeNameObj = document.getElementById("s_" + activeName);
        activeNameObj.style.backgroundColor = "#313131";
        activeNameObj.style.color = "#e2e2e2";

        searchBoxObj.value = activeNameObj.innerHTML;
        return;
    }

    //if the down arrow key is pressed
    if (e.keyCode === 40 && activeName < numNames - 1) {
        //add code here to handle down arrow key, e.g. select the next item 
        
        if(typeof(activeNameObj) != "undefined") {
            activeNameObj.style.backgroundColor = "#FFF";
            activeNameObj.style.color = "black";

        }
        activeName++;
        activeNameObj = document.getElementById("s_" + activeName);
        activeNameObj.style.backgroundColor = "#313131";
        activeNameObj.style.color = "#e2e2e2";
        searchBoxObj.value = activeNameObj.innerHTML;
    }
}



//when a name is clicked, fill the search box with the name and then hide the suggestion list
function clickName(name) {
    //display the name in the search box
    searchBoxObj.value = name.innerHTML;

    //hide all suggestions
    suggestionBoxObj.style.display = 'none';
    suggestionBoxObj.style.opacity = '0';

}

