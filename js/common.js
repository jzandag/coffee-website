/**
 * PREDEFINED JAVASCRIPT FUNCTIONS
 */

// function includeHTML() {
//   var z, i, elmnt, file, xhttp;
//   /*loop through a collection of all HTML elements:*/
//   z = document.getElementsByTagName("*");
//   for (i = 0; i < z.length; i++) {
//     elmnt = z[i];
//     /*search for elements with a certain atrribute:*/
//     file = elmnt.getAttribute("w3-include-html");
//     if (file) {
//       /*make an HTTP request using the attribute value as the file name:*/
//       xhttp = new XMLHttpRequest();
//       xhttp.onreadystatechange = function() {
//         if (this.readyState == 4) {
//           if (this.status == 200) {elmnt.innerHTML = this.responseText;}
//           if (this.status == 404) {elmnt.innerHTML = "Page not found.";}
//           /*remove the attribute, and call this function once more:*/
//           elmnt.removeAttribute("w3-include-html");
//           includeHTML();
//         }
//       };      
//       xhttp.open("GET", file, true);
//       xhttp.send();
//       /*exit the function:*/
//       return;
//     }
//   }
// }

function update_list_main(text = ''){
    $.ajax({
        url: "../coffee-website/includes/updateQueueList.inc.php",
        method: "POST",
        data: {update: ''},
        dataType: "json",
        success: function(data){
          console.log('update previous unbrewed brews success');
        }
    })
    
}

// $(document).ready(function() {
//   update_list_main();

//   setInterval(function(){
//     update_list_main();
//   },5000);

// });