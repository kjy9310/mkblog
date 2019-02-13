@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Article</div>
                <div class="panel-body">
                    <form action="/article" method="post">
                    {{ csrf_field() }}
                        <div>
                            <label>TITLE</label><input style="width:70%" type=text name="title"/>
                        </div>
                        <div>
                            <label>category</label>
                            <select name="category_id">
                                <option value='1' selected>test</option>
                            </select>
                        </div>
                        <div id="text-editor" style="width:100%">
                            <div id="editor-buttons">
                                width:<input type="text" id="width" value="500"/>
                                height:<input type="text" id="height" value="0"/>
                                <input type="file" name="4image" id="input-img"/>
                                <input type="button" value="addImage" onclick="addImage()"/>
                                <input type="button" value="code" onclick="addPre()"/>
                            </div>
                            <div id="content-div" contentEditable="true">
                                <p></p>
                            </div>
                            <textarea name="content" style="width:100%" id="content-input">

                            </textarea>
                        </div>
                        <input type="submit"/>
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
#text-editor{
    border: 2px solid magenta;
}
#content-div{
    padding:5px;
    min-height:200px;
    width:100%; 
    border:1px solid black;
}
#content-div p:before{
    content:"⏎";
}
.img-div{
    text-align:center;
}
#content-div .img-div img{
    display:inline-block;
}
#content-div pre{
    border:2px dotted red;
}
</style>
@endsection

@section('script')
<script>
setInterval(function(){
    document.getElementById('content-input').value=document.getElementById('content-div').innerHTML
},1500);
function addPre(){
    document.getElementById('content-div').innerHTML+="<p>code start</p><pre>code</pre><p>code done</p>";
}
function addImage() {
    var tgt = document.getElementById('input-img'),
    files = tgt.files;
    // FileReader support
    if (FileReader && files && files.length) {
        var fr = new FileReader();
        fr.onload = async function () {
            var width = document.getElementById('width').value;
            var height = document.getElementById('height').value;
            const imgdata = await resizeBase64Img(fr.result,width, height);
            var img = document.createElement('img')
            console.log(imgdata.length);
            img.src=imgdata;
            var imgdiv = document.createElement('div');
            imgdiv.className="img-div";
            imgdiv.appendChild(img);
            var p = document.createElement('p');
            p.appendChild(imgdiv);
            document.getElementById('content-div').appendChild(p);
            document.getElementById('content-div').appendChild(document.createElement('p'));
        }
        fr.readAsDataURL(files[0]);
    }
    // Not supported
    else {
        alert("unsupported browser!! :S");
    }
}

async function resizeBase64Img(file, width, height) {
    var canvas = document.createElement("canvas");
    var img = document.createElement('img');
    img.src = file;
    console.log(width,height)
    var x = await new Promise (function (resolve){
        img.onload = function(){
            var self = this;
            var context = canvas.getContext("2d");
            var w_ratio = width/self.width
            var h_ratio = height/self.height
            if (width==0){
                canvas.width = img.width*h_ratio;
                w_ratio = h_ratio;
            }else{
                canvas.width = width;
            }
            if (height==0){
                canvas.height = img.height*w_ratio;
                h_ratio = w_ratio
            }else{
                canvas.height = height
            }
            context.scale(w_ratio, h_ratio);
            context.drawImage(self, 0, 0);
            resolve(canvas.toDataURL("image/jpeg"));
            // canvas.toDataURL("image/png");
        }   
    } );
    return x;
}
</script>
@endsection