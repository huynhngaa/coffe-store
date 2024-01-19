
  <select id="district">
    <option value="">Chọn quận/huyện</option>
  </select>

  <select id="ward">
    <option value="">Chọn phường/xã</option> 
  </select>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>

    // URL API 
const host = "https://provinces.open-api.vn/api/";

// Mã Tỉnh/Thành phố Cần Thơ
const cityId = "92"; 

// Hàm gọi API lấy danh sách quận/huyện
var callApiDistrict = (api) => {
  return axios.get(api)
    .then((response) => {
      renderData(response.data.districts, "district");
  });
}

// Hàm gọi API lấy danh sách phường/xã  
var callApiWard = (api) => {
  return axios.get(api)
    .then((response) => {
      renderData(response.data.wards, "ward");
  });
}

// Hàm hiển thị danh sách lên Select
var renderData = (array, select) => {
  let row = '<option value="">Chọn</option>';
  
  array.forEach(e => {
    row += `<option value="${e.code}">${e.name}</option>`;
  });

  $(`#${select}`).html(row);
}

// Lấy danh sách quận/huyện khi load trang
callApiDistrict(host + "p/" + cityId + "?depth=2"); 

// Lấy danh sách phường/xã khi thay đổi quận/huyện
$("#district").change(function() {
  const districtId = $(this).val();
  
  callApiWard(host + "d/" + districtId + "?depth=2");
});
</script>