@extends('layouts.admin', [
  'page_header' => 'Dashboard',
  'dash' => 'active',
  'quiz' => '',
  'users' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
])

@section('content')
  <div class="box">
  <div class="box-body">
      <h3>Edit Page: {{ $page->name }}
        <a href="{{url()->previous()}}" class="btn btn-gray pull-right"><i class="fa fa-arrow-left"></i> Back</a></h3>
    <hr>
    <form class="col-md-8" action="{{ route('pages.update',$page->id) }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <label for="name">Page Title:</label>
      <input required type="text" value="{{ $page->name }}" name="name" class="form-control" aria-label="Page Title">
      <br>
      <label for="editor">Page Content:</label>
      <div id="editor" style="height: 200px;">{!! $page->details !!}</div>
      <input type="hidden" name="details" id="details-input">
      <br>
        <label for="status">Status</label>
        <input {{$page->status =="1" ? "checked" : ""}} type="checkbox" class="toggle-input" name="status" id="toggle">
        <label for="toggle"></label>
          <br>

        <label>Show in menu:</label>
        <input {{$page->show_in_menu =="1" ? "checked" : ""}} type="checkbox" class="toggle-input" name="show_in_menu" id="show_in_menu">
        <label for="show_in_menu"></label>
        <p class="help-block">(IF enable it will show as menu item in top menu)</p>

      <button type="submit" class="btn btn-success btn-md">
          <i class="fa fa-save"></i> Update
      </button>
    </form>
  </div>
  </div>
@endsection

@section('scripts')
  <script>
    var quill = new Quill('#editor', {
      theme: 'snow',
      modules: {
        toolbar: [
          [{ 'font': [] }, { 'size': [] }],
          ['bold', 'italic', 'underline', 'strike'],
          [{ 'color': [] }, { 'background': [] }],
          [{ 'align': [] }],
          [{ 'list': 'ordered' }, { 'list': 'bullet' }],
          ['link', 'image'],
          ['code-block', 'blockquote'],
          ['clean']
        ]
      }
    });
    document.querySelector('form').addEventListener('submit', function(){
      document.getElementById('details-input').value = quill.root.innerHTML;
    });
  </script>
@endsection
