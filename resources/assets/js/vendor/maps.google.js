function getZipData(zip, elem){
  var lat;
  var lng;
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({ 'address': zip }, function (results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
          geocoder.geocode({'latLng': results[0].geometry.location}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
              if (results[1]) {
                  var loc = getCityState(results);
              }
          }
      });
      }
  });

  function getCityState(results)
  {
      var a = results[0].address_components;
      var city, state;
      for(i = 0; i <  a.length; ++i)
      {
         var t = a[i].types;
         if(compIsType(t, 'administrative_area_level_1'))
            state = a[i].long_name; //store the state
         else if(compIsType(t, 'locality'))
            city = a[i].long_name; //store the city
      }
      document.getElementById(elem).innerHTML = city + ', ' + state;
  }

}

function fillZipData(zip, elem){
  var lat;
  var lng;
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({ 'address': zip }, function (results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
          geocoder.geocode({'latLng': results[0].geometry.location}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
              if (results[1]) {
                  var loc = getCityState(results);
              }
          }
      });
      }
  });

  function getCityState(results)
  {
      var a = results[0].address_components;
      var city, state;
      for(i = 0; i <  a.length; ++i)
      {
         var t = a[i].types;
         if(compIsType(t, 'administrative_area_level_1'))
            state = a[i].long_name; //store the state
         else if(compIsType(t, 'locality'))
            city = a[i].long_name; //store the city
      }
      elem.html(city + ', ' + state);
  }

}


function compIsType(t, s) {
   for(z = 0; z < t.length; ++z)
      if(t[z] == s)
         return true;
   return false;
}
