let map = L.map('map').setView([39.64, 22.42], 12);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 19
}).addTo(map);

fetch("http://localhost/gasstation.php")
  .then(res => res.json())
  .then(data => {

    console.log("API RESPONSE:", data);

    if (!data.data) {
      console.error("No data array found!");
      return;
    }

    data.data.forEach(s => {

      if (!s.gasStationLat || !s.gasStationLong) return;

      L.marker([
        parseFloat(s.gasStationLat),
        parseFloat(s.gasStationLong)
      ])
      .addTo(map)
      .bindPopup(`
        <b>${s.gasStationName ?? "Station"}</b><br>
        ${s.gasStationAddress ?? ""}
      `);

    });

  })
  .catch(err => {
    console.error("Fetch error:", err);
  });