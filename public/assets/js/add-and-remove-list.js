let index = 0;

function deleteRow(btn) {
    var row = btn.parentNode;
    index -= 1;
    row.remove(row);
}

function add_append() {
    index = index + 1;
    let addColorRow = '<div class="form-group form-inline ml-md-4"><label for="color"> Tên màu :</label><input type="text" id="color" name="color_name[]" placeholder="Tên màu" class="form-control col-md-1 mx-sm-3"><input type="file" accept="image/*" multiple required name="image_colors[]"> <button type="button" class="btn-xoa btn btn-outline-danger" onclick="deleteRow(this);"><i class="fa-solid fa-minus"></i></button></div>';
    $('.add_color_and_size').append(addColorRow);

}