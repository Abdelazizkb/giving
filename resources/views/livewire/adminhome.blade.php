<div class="ml-5">
<h1 class="mb-3 text-monospace">Les statistique d'aujourd'hui :</h1>
 
    
    <div class="bg-white col-md-4 d-inline-flex  p-3 m-2">
        <div class="d-inline-block mr-2  ml-4">

            <p class="d-block text-success text-center font-weight-bolder">  {{$publication['new']}}<i class="fa fa-arrow-up ml-1"></i></p>
            <p class=" text-center"> Nouvelles publications </p>

        </div>

        <div class="d-inline-block  ml-5">

            <p class="d-block text-success text-center font-weight-bolder">
                {{$publication['all']}}</p>
            <p class=" text-center"> Nombre totale </p>
        </div>
    </div>

    <div class="bg-white col-md-4 d-inline-flex p-3 m-2">
        <div class="d-inline-block mr-2  ml-5">

            <p class="d-block text-success text-center font-weight-bolder">  {{$publication['new_demande']}}<i class="fa fa-arrow-up ml-1"></i></p>
            <p class=" text-center"> Nouvelles demandes </p>

        </div>

        <div class="d-inline-block  ml-5" >

            <p class="d-block text-success text-center font-weight-bolder">
                {{$publication['demande']}}</p>
            <p class=" text-center"> Nombre totale </p>
        </div>
    </div>


    <div class="bg-white col-md-4 d-inline-flex  p-3 m-2">
        <div class="d-inline-block mr-2  ">

            <p class="d-block text-success text-center font-weight-bolder">  {{$publication['new_donation']}}<i class="fa fa-arrow-up ml-1"></i></p>
            <p class=" text-center"> Nouveaux publications d'aide </p>

        </div>

        <div class="d-inline-block  ml-5">

            <p class="d-block text-success text-center font-weight-bolder">
                {{$publication['donation']}}</p>
            <p class=" text-center"> Nombre totale </p>
        </div>
    </div>





    <div class="bg-white col-md-4 d-inline-flex p-3 m-2">
        <div class="d-inline-block mr-2  ml-5">

            <p class="d-block text-success text-center font-weight-bolder">  {{$annonce['new']}}<i class="fa fa-arrow-up ml-1"></i></p>
            <p class=" text-center"> Nouvelles annonces</p>

        </div>

        <div class="d-inline-block  ml-5">

            <p class="d-block text-success text-center font-weight-bolder">
                {{$annonce['all']}}</p>
            <p class=" text-center"> Nombre totale </p>
        </div>
    </div>




    
    <div class="bg-white col-md-4 d-inline-flex p-3 m-2">
        <div class="d-inline-block mr-2  ml-5">

            <p class="d-block text-success text-center font-weight-bolder">  {{$donor['new']}}<i class="fa fa-arrow-up ml-1"></i></p>
            <p class=" text-center"> Nouveaux donateurs </p>

        </div>

        <div class="d-inline-block  ml-5">

            <p class="d-block text-success text-center font-weight-bolder">
                {{$donor['all']}}</p>
            <p class=" text-center"> Nombre totale </p>
        </div>
    </div>

    
    <div class="bg-white col-md-4 d-inline-flex p-3 m-2">
        <div class="d-inline-block mr-2  ml-5">

            <p class="d-block text-success text-center font-weight-bolder">  {{$membre['new']}}<i class="fa fa-arrow-up ml-1"></i></p>
            <p class=" text-center"> Nouveaux membres </p>

        </div>

        <div class="d-inline-block  ml-5">

            <p class="d-block text-success text-center font-weight-bolder">
                {{$membre['all']}}</p>
            <p class=" text-center"> Nombre totale </p>
        </div>
    </div>

    <div class=" blue  col-md-4 d-inline-flex p-3 m-2 rounded">
        
        <p class="text-white">Pourecentage de demandes pris en charge: </p>
          <div class="circle">
          <div class="chart m-2" id="graph" data-percent="{{$demande}}" ></div>
          </div>
        </div>


    <div class="bg-white col-md-4 d-inline-flex p-3 m-2">
        <div class="d-inline-block mr-2  ml-5">

            <p class="d-block text-success text-center font-weight-bolder">  {{$demandeur['new']}}<i class="fa fa-arrow-up ml-1"></i></p>
            <p class=" text-center"> Nouveaux demandeurs </p>

        </div>

        <div class="d-inline-block  ml-5">

            <p class="d-block text-success text-center font-weight-bolder">
                {{$demandeur['all']}}</p>
            <p class=" text-center"> Nombre totale </p>
        </div>
    </div>
    

    <div class="bg-white col-md-4 d-inline-block aligne-top p-3 m-2">
        <div class="d-inline-block mr-2  ml-5">

            <p class="d-block text-success text-center font-weight-bolder">  {{$response['new']}}<i class="fa fa-arrow-up ml-1"></i></p>
            <p class=" text-center"> Nouveaux reponses </p>

        </div>

        <div class="d-inline-block ml-5">

            <p class="d-block text-success text-center font-weight-bolder">
                {{$response['all']}}</p>
            <p class=" text-center"> Nombre totale </p>
        </div>
    </div>

</div>
<script>


var el = document.getElementById('graph'); // get canvas

var options = {
    percent:  el.getAttribute('data-percent') || 25,
    size: el.getAttribute('data-size') || 220,
    lineWidth: el.getAttribute('data-line') || 15,
    rotate: el.getAttribute('data-rotate') || 0
}

var canvas = document.createElement('canvas');
var span = document.createElement('span');
span.textContent = options.percent + '%';

if (typeof(G_vmlCanvasManager) !== 'undefined') {
    G_vmlCanvasManager.initElement(canvas);
}

var ctx = canvas.getContext('2d');
canvas.width = canvas.height = options.size;

el.appendChild(span);
el.appendChild(canvas);

ctx.translate(options.size / 2, options.size / 2); // change center
ctx.rotate((-1 / 2 + options.rotate / 180) * Math.PI); // rotate -90 deg

//imd = ctx.getImageData(0, 0, 240, 240);
var radius = (options.size - options.lineWidth) / 2;

var drawCircle = function(color, lineWidth, percent) {
        percent = Math.min(Math.max(0, percent || 1), 1);
        ctx.beginPath();
        ctx.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
        ctx.strokeStyle = color;
        ctx.lineCap = 'round'; // butt, round or square
        ctx.lineWidth = lineWidth
        ctx.stroke();
};

drawCircle('#efefef', options.lineWidth, 100 / 100);
drawCircle('#fff', options.lineWidth, options.percent / 100);


</script>