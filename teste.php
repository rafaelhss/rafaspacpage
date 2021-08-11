<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Rafas Home Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="//aframe.io/releases/1.1.0/aframe.min.js"></script>
    <script src="//cdn.jsdelivr.net/gh/donmccurdy/aframe-physics-system@v3.2.0/dist/aframe-physics-system.min.js"></script>
  </head>
  <body>
      
  <script type="text/javascript">
         
    var velocities = []; 
    var hip = 1.2; 
    var maxhip = 280;
    var minhip = 1.2;
    var accelerating = false;
       
    setInterval(function(){
        if(accelerating && hip <= maxhip){
            hip++;
            //document.getElementById("ghost").setAttribute("color", "red");  
            
        } 
        if(!accelerating && hip >= minhip){
            hip--;
            //document.getElementById("ghost").setAttribute("color", "blue");  
        }
        //console.log("hip: " + hip)
    }, 10)     
         
    var updateCamera = function(cam, ghost){
        var vector = document.getElementById("playerball").body.velocity;
        angle = THREE.Math.radToDeg( Math.atan2(vector.x,vector.z) ); 

        var hipotenusa = 3; //distance from ball
        var velocityX = hipotenusa * Math.sin(DegreesToRadians(angle));
        var velocityZ = hipotenusa * Math.cos(DegreesToRadians(angle));

        var x = document.getElementById("playerball").getAttribute("position").x;  
        var y = document.getElementById("playerball").getAttribute("position").y;
        var z = document.getElementById("playerball").getAttribute("position").z;

        var pos = x+ ", " + y + ", " + z;
        
        ghost.setAttribute("position", pos); 
        
        var rot = document.getElementById("cam").getAttribute("rotation");
      //  rot.x += 270;
        //rot.y += 180;
        ghost.setAttribute("rotation", rot);

        
        x -= velocityX * 15;
        z -= velocityZ * 15;
        y += 20; // always 10 up

        cam.components.camera.camera.parent.position.set(x, y, z);         
    }  
    
    AFRAME.registerComponent('cursor-listener', {
        init: function () {
            this.el.addEventListener('mousedown', function (evt) {
                 accelerating = true;
            });
            this.el.addEventListener('mouseup', function (evt) {
                 accelerating = false;
            });
        }
    });     
         
    function DegreesToRadians(valDeg){
        return ((2*Math.PI)/360*valDeg)
    }
         
	AFRAME.registerComponent("listener", {
		schema : 
		{
			stepFactor : {
				type : "number",
				default : 0.05
			}
		},
		tick : function()
		{	
            var angle = (document.getElementById("cam").getAttribute("rotation").y);
            
            
            var velocityX = 10;
            var velocityY = 10;

            velocityX = hip * Math.sin(DegreesToRadians(angle))
            velocityZ = hip * Math.cos(DegreesToRadians(angle))
            
            var origVelX = document.getElementById("playerball").body.velocity.x;
            var origVelY = document.getElementById("playerball").body.velocity.y;
            var origVelZ = document.getElementById("playerball").body.velocity.z;
            
            
            //modo direto
            document.getElementById("playerball").body.velocity.set(-velocityX, origVelY, -velocityZ);
            
           
            //updade camera 
            updateCamera(this.el, document.getElementById("ghost")); 
           
            
           /* this.el.components.camera.camera.parent.position.add(this.el.components.camera.camera.getWorldDirection().multiplyScalar(this.data.stepFactor));
           */
		}
	});
</script> 
    
    <a-scene physics="restitution: 0.01" id="sce" cursor="rayOrigin: mouse">
        <a-assets>
            <!-- <img id="sky" src="img/sky.jpg" crossorigin="anonymous" /> 
         
    -->
            <a-asset-item id="ghost-obj" src="models/ghost/3d-model.obj"></a-asset-item>
            <img id="lava" src="img/lava.jpg" crossorigin="anonymous" /> 
            
            
            <a-mixin id="text" text="side: double; color: red; width: 80; align: center; value: anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B anos na serie B"></a-mixin>
            




            
            <a-mixin id="instructions" text="side: double; color: blue; width: 400; align: center; value: A cada visita diaria consecutiva voce destrava um novo nivel com novos conteudos. Se ficar um dia sem acessar o site, volta ao nivel 0."></a-mixin>
        
          </a-assets>
        
        <!--<a-sky src="#sky"></a-sky> -->
        
        <a-camera id="cam"  listener="stepFactor:0.005" position="0 4 3">

        </a-camera>
        

        <a-sphere id="playerball"  position="-400 3 -400" radius="4" dynamic-body visible="false"></a-sphere>
        


        <!-- Physics terrain 
        <a-box id="terrain" width="1000" height="0.1" depth="1000" position="0 -1 0" static-body visible="true" color="gray" material="opacity: 1; src: #lava; repeat: 20 20;"  ></a-box>
        <a-box id="terrain" width="1000" height="0.1" depth="1000" position="0 -1 1000" static-body visible="true" color="gray" material="opacity: 1; src: #lava; repeat: 20 20;"  ></a-box>
        -->
       
       

       
       <?php
       
             
              function getLevelContent($levelN){

                return [
                  [
                    "Bem vinde ao nivel 1. Aqui, coisas que fiz e estao por ai nas internets.",
                    "img/futebol5.jpg",
                    "img/dossoccer3.jpg",
                    "img/kicks.jpg",
                    "img/dossoccer1.jpg",
                    "img/casca.jpg"
                  ],
                  [
                    "Bem vinde ao nivel 2. Aqui, coisas que me esforcei para conseguir fazer.",
                    "img/futebol5.jpg",
                    "img/dossoccer3.jpg",
                    "img/kicks.jpg",
                    "img/dossoccer1.jpg",
                    "img/casca.jpg"
                  ]
                ];
              }

              function setPlaceholders($levelN, $terrain_size) {
                
             

                $levelContent = getLevelContent($levelN);
                
                
                
                $placeholders = [[-400, 400],
                [-400, 150],
                [-400, 0],
                [400, -400],
                [250, 140],
                [-270, -140]];

                foreach ($placeholders as &$placeholder) {

                $z = $placeholder[1] + ($levelN * $terrain_size);  
                
                echo "<a-entity
                dynamic-body
                geometry=\"primitive: box; height: 50; width: 50; depth: 50; color: tomato;\"
                mixin=\"text\"
                material=\"opacity: 1; src: #lava;\"
                position=\"". $placeholder[0] ." 25 ". $z ."\"></a-entity>    ";
                }                              
              }  
                     
              function createLevel($levelN) {


                    
                     $terrain_size = 1000;
                     $terrain_z = $terrain_size * $levelN;

                     echo "<a-box class=\"terrain\" width=\"" . $terrain_size . "\" height=\"0.1\" depth=\"" . $terrain_size . "\" position=\"0 -1 ". $terrain_z ."\" static-body visible=\"true\" color=\"gray\" material=\"opacity: 1; src: #lava; repeat: 20 20;\"></a-box>";
                     
                     $out_vert_dimentions = ["1000", "250", "10"];
                     $out_horiz_dimentions = ["10", "250", "1000"];
                     $vert_dimentions =  ["5", "250", "125"];
                     $horiz_dimentions =  ["125", "250", "10"];

                    $open_door = 100;
                    if($levelN % 2 == 0){
                        $open_door = -$open_door;
                    }


                     $walls = [
                            [[$open_door,5,500],$out_vert_dimentions], //door in
                            [[-$open_door,5,-500],$out_vert_dimentions], //door out
                            [[500,5,0],$out_horiz_dimentions],
                            [[-500,5,0],$out_horiz_dimentions],
                            [[-312.5,0,-250],$vert_dimentions],
                            [[-312.5,0,-125],$vert_dimentions],
                            [[187.5,0,-250],$vert_dimentions],
                            [[312.5,0,-125],$vert_dimentions],
                            [[312.5,0,0],$vert_dimentions],
                            [[62.5,0,0],$vert_dimentions],
                            [[187.5,0,0],$vert_dimentions],
                            [[62.5,0,125],$vert_dimentions],
                            [[187.5,0,125],$vert_dimentions],
                            [[-65.5,0,250],$vert_dimentions],
                            [[-125,0,-312.5],$horiz_dimentions],
                            [[-250,0,-312.5],$horiz_dimentions],
                            [[125,0,-312.5],$horiz_dimentions],
                            [[250,0,-312.5],$horiz_dimentions],
                            [[-125,0,-187.5],$horiz_dimentions],
                            [[0,0,-187.5],$horiz_dimentions],
                            [[125,0,-187.5],$horiz_dimentions],
                            [[250,0,-187.5],$horiz_dimentions],
                            [[-250,0,-62.5],$horiz_dimentions],
                            [[-125,0,-62.5],$horiz_dimentions],
                            [[-375,0,62.5],$horiz_dimentions],
                            [[-375,0,312.5],$horiz_dimentions],
                            [[-250,0,62.5],$horiz_dimentions],
                            [[-125,0,62.5],$horiz_dimentions],
                            [[0,0,62.5],$horiz_dimentions],
                            [[-250,0,187.5],$horiz_dimentions],
                            [[-125,0,187.5],$horiz_dimentions],
                            [[250,0,187.5],$horiz_dimentions],
                            [[375,0,187.5],$horiz_dimentions],
                            [[-312.5,0,312.5],$horiz_dimentions],
                            [[-187.5,0,312.5],$horiz_dimentions],
                            [[125,0,312.5],$horiz_dimentions],
                            [[250,0,312.5],$horiz_dimentions],
                            [[250,0,-312.5],$horiz_dimentions]
                            ];

                     foreach ($walls as &$wall) {
                            $z = $wall[0][2] + ($levelN * $terrain_size);
                            echo "<a-box position=\"" . $wall[0][0] . " " . $wall[0][1] . " " . $z . "\" class=\"innerwall\" width=\"" .$wall[1][0] . "\" height=\"" . $wall[1][1] . "\" depth=\"" . $wall[1][2] . "\" static-body visible=\"true\" material=\"src:#lava; opacity: 0.99\"  ></a-box>";
                            //echo "<script> console.log('PHP: ',",get_option("slides_data"),");</script>"; 
                     }          

                     setPlaceholders($levelN, $terrain_size);
              }   



              function createHell($lastLevelN) {
                $terrain_size = 1000;
                
                $terrain_z = ($terrain_size * $lastLevelN) + ($terrain_size/2);
                echo "<a-box class=\"underterrain\" width=\"" . $terrain_size . "\" height=\"0.1\" depth=\"" . $terrain_size . "\" position=\"0 -500 ". $terrain_z ."\" static-body visible=\"true\" color=\"gray\" material=\"opacity: 1; src: #lava; repeat: 20 20;\"></a-box>";
                echo "<a-entity geometry=\"primitive: plane; height: auto; width: auto; color: tomato;\" mixin=\"instructions\"  material=\"opacity: 1;\" rotation=\"0 270 0\" position=\"0 -400 ". $terrain_z ."\"></a-entity>    ";
                
                $firstterrain_z = 0 - ($terrain_size/2);
                echo "<a-box class=\"underterrain\" width=\"" . $terrain_size . "\" height=\"0.1\" depth=\"" . $terrain_size . "\" position=\"0 -500 ". $firstterrain_z ."\" static-body visible=\"true\" color=\"gray\" material=\"opacity: 1; src: #lava; repeat: 20 20;\"></a-box>";
                echo "<a-entity geometry=\"primitive: plane; height: auto; width: auto; color: tomato;\" mixin=\"instructions\"  material=\"opacity: 1;\" rotation=\"0 270 0\" position=\"0 -400 ". $firstterrain_z ."\"></a-entity>    ";
                
                for ($i = 1; $i <= $terrain_size; $i = $i+50) {
                  for ($j = 1; $j <= $terrain_size; $j = $j+50) {
                    $x = ((0 - ($terrain_size/2)) + $i) + rand(0, 40);
                    $z = (((0 - ($terrain_size/2)) + $j)  + rand(0, 40)) + $firstterrain_z;
                    echo "<a-cone color=\"gray\" height=\"50\"  radius-bottom=\"6\" radius-top=\"0\" position=\"". $x ." -500 ". $z ."\"></a-cone>";


                    $z = (((0 - ($terrain_size/2)) + $j)  + rand(0, 15)) + $terrain_z;
                    echo "<a-cone color=\"gray\" height=\"50\"  radius-bottom=\"6\" radius-top=\"0\" position=\"". $x ." -500 ". $z ."\"></a-cone>";
                  }
              }

                



              }


              createLevel(0);
              createLevel(1);
              createLevel(2);
              createHell(2);  

              
      ?>

               


<!-- Atenção! Bug do a-frame: Se for cursor listener tem que estar depois dos text -->
<a-sphere  
                  cursor-listener
                  obj-model="obj: #ghost-obj;" 
                  id="ghost"
                  rotation="0 310 0"
                  scale="5 5 5 "
                  shadow></a-sphere> 
    </a-scene>
  </body>
  <script>
   
  
    /*
    var playerEl = document.getElementById("playerball")

    playerEl.addEventListener('collide', function (e) {
        
        if(e.detail.body.el.className.indexOf("bolaenemy") >=0){
            score = score + 1;
            document.getElementById("scoren").innerHTML = score;
            //document.getElementById("score").setAttribute("text", "value: "+score+";");
            
            var pos = e.detail.body.el.body.position;
            e.detail.body.el.body.position.set(pos.x, -5, pos.z);
            
            var v = e.detail.target.el.body.velocity;
            e.detail.body.el.body.velocity.set(v.x, v.y, v.z);
        }
        if(e.detail.body.el.className.indexOf("bonus") >=0){
            
            var v = e.detail.target.el.body.velocity;
            e.detail.target.el.body.velocity.set(v.x, 30, v.z);
        }
        
        
      e.detail.target.el;  // Original entity (playerEl).
      e.detail.body.el;    // Other entity, which playerEl touched.
      e.detail.contact;    // Stats about the collision (CANNON.ContactEquation).
      e.detail.contact.ni; // Normal (direction) of the collision (CANNON.Vec3).
    }); 
   
})*/
  </script>
</html>