
    <style>
        img.scanned {
            height: 200px; /** Sets the display size */
            margin-right: 12px;
        }
        div#images {
            margin-top: 20px;
        }
    </style>
<div class="row">
    <h2 class="row-centered col-md-12">
        WS
    </h2>
    <div class="col-md-12">
        <div id="status">
        </div>
        <div id="message">
        </div>
        <a id="tester" class="btn btn-default">TESTER
        </a>
        <a id="send" class="btn btn-default">SEND
        </a>

    <button type="button" class="btn btn-default" id="scan">Scan</button>
    <form id="form1" action="https://asprise.com/scan/applet/upload.php?action=dump" method="POST" enctype="multipart/form-data" target="_blank" >
        <input type="text" id="param1" name="param1" class="form-control" value="Test scan"/>

        <button type="button" class="btn btn-default" id="upload">Upload</button>
    </form>


    <style>
        img.scanned {
            height: 200px; /** Sets the display size */
            margin-right: 12px;
        }
        div#images {
            margin-top: 20px;
        }
    </style>
    <button type="button" class="btn btn-default" id="scan">Scan</button>
    <div id="images"></div>
    <div id="server_response"></div>
    </div>
</div>