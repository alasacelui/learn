  
{{--Course Modal --}}
  <div class="modal fade" id="m_course" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="m_course_title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form class="c_form">
              <div class="form-group">
                  <label class="form-label"> Title </label>
                  <input type="text" class="form-control" name="title">
              </div>
              <div class="form-group">
                <label class="form-label"> Subtitle </label>
                <input type="text" class="form-control" name="subtitle">
            </div>
              <div class="form-group">
                  <label class="form-label"> Description </label>
                  <input type="text" class="form-control" name="description" style="height: 120px">
              </div>
              <div class="form-group">
                  <label class="form-label"> Price </label>
                  <input type="number" min="0" class="form-control" name="price" value="99">
              </div>
              <div class="form-group">
                <label class="form-label"> Instructor </label>
                <input type="text" min="0" class="form-control" name="instructor">
              </div>
              <div class="form-group">
                <label class="form-label"> Select Category </label>
                <select class="form-control" name="category_id" id="course_category"></select>
              </div>
              <input type="file" name="image" id="c_image" >
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn_add_course" onclick="c_store('.c_form','.course_dt', 'course.store')">Submit</button>
            <button type="button" class="btn btn-success btn_update_course" onclick="c_update('.c_form','.course_dt', 'course.update', event)">Update</button>
          </div>
        </form>
        </div>
      </div>
  </div>
{{--End Course Modal--}}

{{--Category Modal--}}
  <div class="modal fade" id="m_category" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="m_category_title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form class="category_form">
            <div class="form-group">
                <label class="form-label"> Category </label>
                <input type="text" class="form-control" name="category">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn_add_category" onclick="c_store('.category_form','.category_dt', 'category.store')">Submit</button>
          <button type="button" class="btn btn-success btn_update_category" onclick="c_update('.category_form','.category_dt', 'category.update', event)">Update</button>
        </div>
      </form>
      </div>
    </div>
  </div>
{{--End Category Modal--}}