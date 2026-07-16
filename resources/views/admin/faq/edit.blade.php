@extends('layouts.admin', [
  'page_header' => 'Edit FAQ',
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
       <form class="col-md-8" action="{{ route('faq.update',$faq->id) }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <label for="title">Faq's Title:</label>
      <input required type="text" name="title" class="form-control" value="{{$faq->title }}" aria-label="FAQ Title">
      <br>
      <label for="editor">Faq's Details:</label>
      <div id="editor" style="height: 200px;">{{ $faq->details }}</div>
      <input type="hidden" name="details" id="details-input">
      <br>
      <button type="submit" class="btn btn-primary btn-md">
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
