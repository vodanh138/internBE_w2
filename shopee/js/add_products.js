document.getElementById("State").addEventListener("change", function () {
    var State = this.value;
    var City = document.getElementById("City");
    City.innerHTML = "<option value =''>Select City</option>";
    document.getElementById("District").innerHTML = "<option value=''>Select District</option>";

    if (State === "Hà Nội") {
        City.innerHTML += `
<option value="Hà Nội">Hà Nội</option>
`;
    }
    else if (State === "Đà Nẵng"){
        City.innerHTML += `
<option value="Đà Nẵng">Đà Nẵng</option>
`;
    }
    else if (State === "Hồ Chí Minh"){
        City.innerHTML += `
<option value="Hồ Chí Minh">Hồ Chí Minh</option>
`;
    }
    else if (State === "Thừa Thiên Huế"){
        City.innerHTML += `
<option value="Huế">Huế</option>
`;
    }
});

document.getElementById("City").addEventListener("change", function () {
    var City = this.value;
    var District = document.getElementById("District");
    District.innerHTML = "<option value =''>Select District</option>";
    document.getElementById("District").innerHTML = "<option value=''>Select District</option>";

    if (City === "Hà Nội") {
        District.innerHTML += `
<option value="Hoàn Kiếm">Hoàn Kiếm</option>
<option value="Đống Đa">Đống Đa</option>
`;
    }
    else if (City === "Đà Nẵng"){
        District.innerHTML += `
<option value="Hải Châu">Hải Châu</option>
<option value="Liên Chiểu">Liên Chiểu</option>
<option value="Sơn Trà">Sơn Trà</option>
<option value="Ngũ Hành Sơn">Ngũ Hành Sơn</option>
<option value="Thanh Khê">Thanh Khê</option>
<option value="Huyện Hòa Vang">Huyện Hòa Vang</option>
<option value="Huyện Hoàng Sa">Huyện Hoàng Sa</option>
`;
    }
    else if (City === "Hồ Chí Minh"){
        District.innerHTML += `
<option value="Quận 1">Quận 1</option>
<option value="Quận 3">Quận 3</option>
<option value="Quận 4">Quận 4</option>
<option value="Quận 5">Quận 5</option>
<option value="Quận 6">Quận 6</option>
<option value="Quận 7">Quận 7</option>
<option value="Quận 8">Quận 8</option>
<option value="Quận 9">Quận 9</option>
<option value="Quận 10">Quận 10</option>
<option value="Quận Gò Vấp">Quận Gò Vấp</option>
`;
    }
    else if (City === "Huế"){
        District.innerHTML += `
<option value="Huế">Huế</option>
`;
    }
});

document.getElementById("add_form").addEventListener("submit", function (event) {
    event.preventDefault();

    var add_name = document.getElementById("add_name").value;
    var add_price = document.getElementById("add_price").value;
    var State = document.getElementById("State").value;
    var City = document.getElementById("City").value;
    var District = document.getElementById("District").value;
    var add_file = document.getElementById("add_file").value;
    
    if (!add_name || !add_price || !State || !City || !District || !add_file) {
      document.getElementById("miss_info").innerText = "*Please enter all the requested information";
      miss_info.style.color = 'red';
    }
    else {
      this.submit();
    }
  });

