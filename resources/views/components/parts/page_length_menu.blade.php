    <div class="row dataTables_wrapper">
        <div class="dataTables_length col-md-12 col-md-offset-0">
          <label>
              <select class="form-control page_length_selector" onchange="common.pageLengthChange(this)">
                @foreach([10, 25, 50, 100] as $_length)
                    <option value="{{$_length}}" @if($_length == $paginator->perPage()) selected="selected" @endif>{{$_length}}</option>
                @endforeach
              </select>
              @lang('Rows per page')
          </label>
        </div>
    </div>