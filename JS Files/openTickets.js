function loadXMLDoc() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        myFunction(this);
      }
    };
    xmlhttp.open("GET", "openTickets.xml", true);
    xmlhttp.send();
  }
  function myFunction(xml) {
    var i;
    var xmlDoc = xml.responseXML;
    var table="<tr><th>Name</th><th>Status</th><th>priority</th>tr>";
    var x = xmlDoc.getElementsByTagName("Open");
    for (i = 0; i <x.length; i++) { 
      table += "<tr><td>" +
      x[i].getElementsByTagName("name")[0].childNodes[0].nodeValue +
      "</td><td>" +
      x[i].getElementsByTagName("status")[0].childNodes[0].nodeValue +
      "</td><td>" +
      x[i].getElementsByTagName("priority")[0].childNodes[0].nodeValue +
      "</td></tr>";
    }
    document.getElementById("OpenTickets").innerHTML = table;
  }