let index = 0;

function deleteRow(btn) {
    var row = btn.parentNode;
    index -= 1;
    row.remove(row);
}

function add_append() {
    index = index + 1;
    let addColorRow = '<div class="form-group form-inline ml-md-4 img-color"><label for="color"> Tên màu :</label><input type="text" name="color_id[]" placeholder="" value="-1" class="form-control col-md-3 mx-sm-3" hidden><input type="text" id="color" name="color_name[]" placeholder="Tên màu" class="form-control col-md-3 mx-sm-3"><input type="file" accept="image/*" required name="image_colors[]"> <button type="button" class="btn-xoa btn btn-outline-danger" onclick="deleteRow(this);"><i class="fa-solid fa-minus"></i></button><div class="form-group ml-2" hidden><label for="status">Trạng thái </label> &ensp; <select name="color_status[]" class="form-control"><option value="0" >Ngưng hoạt động</option><option value="1" selected>Đang hoạt động</option></select></div></div>';
    $('.add_color_and_size').append(addColorRow);
}

function add_size() {
    index = index + 1;
    let addSizeRow = '<div class="form-group form-inline ml-md-4 img-color"><label for="color"> Tên size :</label> <input type="text" name="size_id[]" placeholder="" value="-1" class="form-control col-md-3 mx-sm-3" hidden> <input type="text" id="size" name="size_name[]"placeholder="Tên size" class="form-control col-md-3 mx-sm-3"><button type="button" class="btn-xoa btn btn-outline-danger" onclick="deleteRow(this);"><i class="fa-solid fa-minus"></i></button><div class="form-group ml-2" hidden><label for="status">Trạng thái </label> &ensp; <select name="size_status[]" class="form-control"><option value="0" >Ngưng hoạt động</option><option value="1" selected>Đang hoạt động</option></select></div></div>';
    $('.add_size').append(addSizeRow);
}

function add_product(btn) {
    // document.getElementById("dataTable").deleteRow(btn.parentNode.index);
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    
    row.deleteCell(4);
    var cell = row.insertCell(4);
    cell.innerHTML = '<button onclick="remove_product(this);" type="button"  class="btn btn-danger"><i class="fa-solid fa-minus"></i></button>';
    document.getElementById("dataTableSlide").append(row);
}

function remove_product(btn) {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    
    row.deleteCell(4);
    var cell = row.insertCell(4);
    cell.innerHTML = '<button onclick="add_product(this);" type="button"  class="btn btn-info btn-color"><i class="fa-solid fa-circle-plus"></i></button>';
    document.getElementById("dataTable").append(row);
    
}

