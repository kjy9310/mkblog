@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Article</div>
                <div class="panel-body">
                    <form action="/article" method="post">
                        <div>
                            <label>TITLE : </label>
                            <input type=text name="title"/>
                        </div>
                        <div id="text-editor" style="width:100%">
                            <div id="editor-buttons">
                                <input type="file" name="4image" id="input-img"/>
                                <input type="button" value="addImage"/>
                                <input type="button" value="code" onclick="addPre()"/>
                            </div>
                            <div id="content-div" contentEditable="true">
                                <p></p>
                            </div>
                            <textarea name="content" style="width:100%">

                            </textarea>
                        </div>
                    </form>
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>
#content-div{
    min-height:200px;
    width:100%; 
    border:1px solid black;
}
#content-div pre{
    border:2px dotted red;
}
</style>
@endsection

@section('script')
<script>
function addPre(){
    document.getElementById('content-div').innerHTML+="<div>code start</div><pre>code</pre><div>code done</div>";
}
function toPng(){
    canvas.toDataURL("image/png");
}
</script>
@endsection