<style>
    input[type='checkbox'] {
        -webkit-appearance:none;
        width:40px;
        height:40px;
        margin:5px;
        background:white;
        border-radius:10px;
        border:2px solid #222;
    }
    input[type='checkbox']:checked {
        background: rgba(81, 73, 62, .8);
    }

    .vertAlign {
        display: inline-block;
        vertical-align: middle;
        background: yellow;
        padding: 3px 5px;
    }
    
    body,
    html {
        height: 100%;
        margin: 0;
    }

    h1 {

        background: #ccc;
        color: rgba(92, 128, 4, 18);
        padding: 10px 20px 10px 20px;
        margin: 10px;
        border-radius: 15px;

    }

    h4 {
        background: rgba(81, 73, 62, .8);
        color: #fff;
        padding: 10px 15px 10px 15px;
        margin: 5px 0px;
        border-radius: 5px;
        text-align: center;
        vertical-align: middle;
    }

    h5 {
        color: rgba(81, 73, 62, .8);
    }
    
    h6 {
        background: rgba(81, 73, 62, .2);
        color: #333;
        padding: 10px 15px 10px 15px;
        margin: 5px 20px;
        border-radius: 5px;
        border-style: solid;
        border-width: 2px;
    }

    .floorButton {
        background: rgba(81, 73, 62, .8);
        color: #ddd;
        font-size: small;
        padding: 3px 5px 3px 5px;
        border-radius: 5px;
        border-style: solid;
        border-width: 3px;
        border-color: #fff;
        text-align: center;
        vertical-align: middle;
    }

    .handoverHeader {
        background: rgba(92, 160, 4, .6);
        color: #ddd;
        font-weight: bold;
        padding: 10px 15px 10px 15px;
        margin: 5px 20px;
        border-radius: 5px;
        border-style: solid;
        border-width: 2px;
    }

    .handover {
        background: rgba(81, 73, 62, .2);
        color: #111;
        padding: 10px 15px 0px 15px;
        margin: 5px 20px;
        border-radius: 5px;
        border-style: solid;
        border-width: 1px;
        overflow: hidden;
    }
    
    .bg {
        /* The image used */
        /*background-image: url("/images/background_orig.jpg");*/
        background: #ddd;
        min-height: 100%;
        background-attachment: fixed;
        background-position: top;
        background-size: 100% auto;
    }

/* this is to wrap text in the handover <pre> tags */
pre {
    white-space: pre-wrap;       /* Since CSS 2.1 */
    white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
    white-space: -pre-wrap;      /* Opera 4-6 */
    white-space: -o-pre-wrap;    /* Opera 7 */
    word-wrap: break-word;       /* Internet Explorer 5.5+ */
}

    .indexrow {
        margin: 10px;
    }

    .indexborder {
        border: 2px solid rgba(81, 73, 62, .8);
        border-radius: 15px;
        margin: 10px;
        padding: 10px 20px 10px 10px;
    }

    .topBottom {
        margin: 10px 0px 10px 0px;
    }

    .centerEverything {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100vw;
        height: 100vh;
    }

    .fullScreen {
        width: 100vw;
        height: 100vh;
    }

    .greenBox {

        background: rgba(92, 128, 4, 18);
        color: white;
        padding: 15px;
        margin: 10px;
        border-radius: 5px;

    }

    .lightGreenBox {

        background: rgba(92, 160, 4, .6);
        color: white;
        padding: 10px;
        margin: 10px;
        border-radius: 5px;

    }

    .offGreenBox {

        background: rgba(150, 150, 30, 1);
        padding: 15px;
        margin: 10px;
        border-radius: 15px;

    }

    .whiteBackground {

        background: rgba(255, 255, 255, .8);
        color: gray;
        padding: 10px;
        margin: 10px;
        border-radius: 5px;

    }

    .greyBackground {

        background: rgba(200, 200, 200, .8);
        color: gray;
        padding: 10px;
        margin: 10px;
        border-radius: 5px;

    }

    .blueBackground {

        background: rgba(39, 68, 216, .8);
        color: white;
        padding: 10px;
        margin: 10px;
        border-radius: 5px;

    }

    .greenBackground {

        background: rgba(39, 216, 41, .8);
        color: white;
        padding: 10px;
        margin: 10px;
        border-radius: 5px;

    }

    .redBackground {

        background: rgba(216, 39, 39, .8);
        color: white;
        padding: 10px;
        margin: 10px;
        border-radius: 5px;

    }

    .yellowBackground {

        background: rgba(191, 176, 40, .8);
        color: white;
        padding: 10px;
        margin: 10px;
        border-radius: 5px;

    }

    .purpleBackground {

        background: rgba(175, 24, 158, .8);
        color: white;
        padding: 10px;
        margin: 10px;
        border-radius: 5px;

    }

    .brownBackground {
        background: rgba(127, 95, 25, .8);
        color: white;
        padding: 10px;
        margin: 10px;
        border-radius: 5px;
    }

    .fail {
        border-style: dashed;
        border-width: 4px;
        border-color: darkred;
    }

    .container {
        padding: 30px;
        margin-top: 40px;
    }

    .leaguescores {
        text-align: center;
        border-radius: 15px;
        -moz-border-radius: 15px;
        padding: 20px;
    }

    .leagueteams {
        text-align: left;
        border-radius: 15px;
        -moz-border-radius: 15px;
        padding: 20px;
    }

    .custombutton {
        width: 90px !important;
    }

    .acttable {
        width: 100%;
        align-content: center;
    }

    .leaguetable {
        align-content: center;
        width: 100%;
    }

    .showacttable {
        text-align: center;
        border-radius: 15px;
        -moz-border-radius: 15px;
        padding: 5px;
        width: 50%;
    }

    .click a {
        display: block;
    }

    .whitebuttontext {
        color: white;
    }

    /*.alert {
    padding: 20px;
    background-color: #f44336;
    color: white;
}*/

.buttonRight{
    display:flex;
    justify-content:flex-end;
    float: right;
    margin: 5px;
}

.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.closebtn:hover {
    color: black;
}
    
    form {
        width: 80%;
        margin: 0 auto;
    }

    a:link, a:active, a:visited
    {
        text-decoration: none;
        color: inherit;
        border: 0px;
        -moz-outline-style: none;
    }

    

    a:hover {
        text-decoration: none;
        color: gainsboro;
        border: 0px;
        -moz-outline-style: none;
    }

    a:focus {
        outline: none;
        -moz-outline-style: none;
    }

</style>
