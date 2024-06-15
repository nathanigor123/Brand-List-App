  const API_BASE_URL = "http://localhost:8800/api";
  
  function fetchTopList() {
    console.log('aa');
    fetch(`${API_BASE_URL}/brands/toplist`)
      .then((response) => response.json())
      .then((data) => {
        displayBrands(data.data);
      })
      .catch((error) => {
        console.error("Error fetching brands:", error);
      });
  }
  function displayBrands(brands) {
    const brandTable = document.getElementById("brand-table");
    if (brands.length === 0) {
      brandTable.innerHTML = ""; 
      const noDataRow = document.createElement("div");
      noDataRow.classList.add("row");
      noDataRow.innerHTML = `
        <div class="cell"  style="text-align: center;">
          No data available.
        </div>
      `;
      brandTable.appendChild(noDataRow);
    } else {
      let id = 1;
  
      brands.forEach((brand) => {
        const row = document.createElement("div");
        row.classList.add("row");
        const stars = generateStarsHtml(brand.rating, true);
  
        row.innerHTML = `
          <div class="cell" data-title="Id"><strong>${id}</strong></div>
          <div class="cell" data-title="Image">
            <div class="brand-image-container">
              <img src="${brand.brand_image}" alt="${brand.brand_name}">
            </div>
          </div>
          <div class="cell" data-title="Name">${brand.brand_name}</div>
          <div class="cell" data-title="Rating"><div class="stars">
            ${stars}
          </div></div>
        `;
        id++;
        brandTable.appendChild(row);
      });
    }
  }
  
  
  function generateStarsHtml(rating, isActive = true) {
    let starsHtml = "";
    const fullStars = Math.floor(rating);
    const hasHalfStar = rating % 1 !== 0;
  
    for (let i = 0; i < fullStars; i++) {
      starsHtml += `<i class="fas fa-star${isActive ? " active" : ""}"></i>`;
    }
  
    if (hasHalfStar) {
      starsHtml += `<i class="fas fa-star-half-alt${
        isActive ? " active" : ""
      }"></i>`;
    }
  
    for (let i = 0; i < 5 - fullStars - (hasHalfStar ? 1 : 0); i++) {
      starsHtml += `<i class="far fa-star${isActive ? " active" : ""}"></i>`;
    }
  
    return starsHtml;
  }

  fetchTopList();