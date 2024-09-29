<?php
if(isset($_POST['dlcode']))
{
   $today = date("jS F Y");
   header('Content-disposition: attachment; filename=codePuppy '.$today.'.txt');
   header('Content-type: application/txt');
   echo $_POST['dlcode'];
   exit; //stop writing
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="ide.css">

<script type="text/javascript" src="paper.min.js"></script>
<script type="text/paperscript" canvas="paperscriptCanvas">

function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

var canvas_width = view.size.width;
var half_width = canvas_width/2;
var canvas_height = view.size.height;
var half_height = canvas_height/2;

var center = half_width

var bg = new Path.Rectangle({
    point: [0, 0],
    size: [view.size.width, view.size.height],
});
bg.sendToBack();
bg.fillColor = 'white';
function canvas(unit) {
    bg.fillColor = unit;
}

function range(limit) {
    return (Array.from(Array(limit).keys()));
}

function helper() {

xcor = 0;
while (xcor < canvas_width){
    var myPath = new Path();
    myPath.strokeColor = "#adadad";
    myPath.strokeWidth = .3;
    myPath.add(new Point(xcor, 0), new Point(xcor, canvas_height));
    xcor += 10;
}

ycor = 0;
while (ycor < canvas_height){
    var myPath = new Path();
    myPath.strokeColor = "#adadad";
    myPath.strokeWidth = .3;
    myPath.add(new Point(0, ycor), new Point(canvas_width, ycor));
    ycor += 10;
}


xcor = 0;
while (xcor < canvas_width){
    var myPath = new Path();
    myPath.strokeColor = "silver";
    myPath.strokeWidth = .5;
    myPath.add(new Point(xcor, 0), new Point(xcor, canvas_height));
    if (xcor > 0) {
    var text = new PointText(new Point(xcor, 20));
    text.justification = 'center';
    text.fillColor = 'black';
    text.content = xcor;
    }
    xcor += 100;
}

ycor = 0;
while (ycor < canvas_height){
    var myPath = new Path();
    myPath.strokeColor = "silver";
    myPath.strokeWidth = .5;
    myPath.add(new Point(0, ycor), new Point(canvas_width, ycor));
    if (ycor > 0) {
    var text = new PointText(new Point(20, ycor+5));
    text.justification = 'center';
    text.fillColor = 'black';
    text.content = ycor;
    }
    ycor += 100;
}
}

function circle(x,y,size,color) {
    shape = new Path.Circle(new Point(x, y), size);
    shape.fillColor = color;
    return shape;
}

function semicircle(x,y,size,color) {
    shape = new Path();
    shape.add(new Point(x-size, y));
    shape.arcTo(new Point(x+size, y));
    shape.fillColor = color;
    return shape;
    
}

function line(fromx,fromy,tox,toy,width,color) {
    shape = new Path();
    shape.add(new Point(fromx, fromy));
    shape.add(new Point(tox, toy));
    shape.strokeColor = color;
    shape.strokeWidth = width;
    return shape;
}

function polygon(x,y,sides,size,color) {
    shape = new Path.RegularPolygon(new Point(x, y), sides, size);
    shape.fillColor = color;
    return shape;
}

function text(x,y,textvalue,color) {
    var textval = new PointText(new Point(x, y));
    textval.justification = 'center';
    textval.fillColor = color;
    textval.content = textvalue;    
    textval.fontSize = 24;
    return textval;
}



function triangle(x,y,size,color) {
    return polygon(x,y,3,size,color)
}

function square(x,y,size,color) {
    return polygon(x,y,4,size,color)
}

function pentagon(x,y,size,color) {
    return polygon(x,y,5,size,color)
}

function hexagon(x,y,size,color) {
    return polygon(x,y,6,size,color)
}

function heptagon(x,y,size,color) {
    return polygon(x,y,7,size,color)
}

function octogon(x,y,size,color) {
    return polygon(x,y,8,size,color)
}

function nonagon(x,y,size,color) {
    return polygon(x,y,9,size,color)
}

function decagon(x,y,size,color) {
    return polygon(x,y,10,size,color)
}

function moveLeft(sprite,speed) {
    sprite.position.x -= speed;
}

function moveRight(sprite,speed) {
    sprite.position.x += speed;
}

function moveUp(sprite,speed) {
    sprite.position.y -= speed;
}

function moveDown(sprite,speed) {
    sprite.position.y += speed;
}

function increment(sprite,speed) {
    sprite.content = parseInt(sprite.content) + speed;
}

function complexstar(x,y,radius1,radius2,points,color){
    var path = new Path.Star(new Point(x,y), points, radius1, radius2);
    path.fillColor = color;
    return path;
}

function star(x,y,radius,color){
    return complexstar(x,y,radius,radius/3,5,color);
}


function rectangle(fromx,fromy,tox,toy,color){
    var bottomLeft = new Point(fromx, fromy);
    var topRight = new Point(tox, toy);
    var rect = new Rectangle(bottomLeft, topRight);
    shape = new Path.Rectangle(rect);
    shape.fillColor = color;
    return shape;
}

function tilemap(width,height,color,mazemap){
    cell = 0;
    for (y in range(height)) {
        for (x in range(width)) {
            if (mazemap.charAt(cell) == "1") {
                square(x*50 + 25, y*50 + 25, 36, color)
            }
            cell += 1;
        }
    }
}

map1="1111111111111111000000000000000111111111101011111010101010101001101010101010110110101010101010011010101010101101100000001010100110111111101011011000000000101001111111111110110110010000000001011001011101110101100101011101110110000000000000011111111111111111"

map2="1111111111111111000000000000000111111111111111011000000000000101101111111111010110000000000001011111111111110101100000000000010111111111101111011000000000000101101111111111010110100010000101011000100010010101101111111111010110000000000000011111111111111111"															
map3="1111111111111111001000101000000110101010111111011010100010000001101011011011111110100101000000011010010101111111101111010000000110000001111111011011110000000001101001111111111110100001000100011010010001000101101111111111110110000000000000011111111111111111"															
map4="1111111111111111001000100010000110101010101011011000101010101001111110001010101110101111100010011010100011111101101000100000000110101111111111111000000000000001111111111111110110000000000000011011111111111111100010001000100110100010001000011111111111111111"															
map5="1111111111111111000010001000100110101010101010111010001000100001111111111111110110010001000100011101010101010101100001000100010110111111111111111010001000100001101010101010101110001000100010011111111111111101100000000000000111010101010101011111111111111111"															
map6="1111111111111111000000000000000110111111111111111000000000000001101111111111111110000000000000011011111111111111100000000000000110111111111111111000100010000001101010101011110110101010101000011010101010101111101010101010000110100010001010011111111111111111"															
map7="1111111111111111001000000000000110101111111111011010100000000101101010111111010110101010000101011010101011010101101010100101010110101010010101011010101111010101101010000001010110101111111101011010000000000101101111111111110110000000000000011111111111111111"															
map8="1111111111111111001010101010000110100010001010111010101010001001101010101010110110001000101000011010101111110111101010100000000110100011101111111010101000000001101010111111011110001000100000011010101010101111101010101010000110101010101010011111111111111111"															
map9="1111111111111111000000000000000111111111111111011000000000000001110111011110111110000000000000011111111110101111100000001010100110111110101010011010101010101101101000101010100111110110101010111000000010101001101111111010110110000000001000011111111111111111"															
map10="1111111111111111000000000000000111111111011111111000000101000001101111010101111110100101010100011010010001010101101101010101110110010001000000011101111101111111100000010101000111010100010101011001010101010101111101110001110110000001010000011111111111111111"															

function mazeMap(color,mapname) {
    mazeMapLayer = new Layer();
    tilemap(16,16,color,mapname);
    controlLayer = new Layer();
    rectangle(800,0,canvas_width,canvas_height,"black")
    rectangle(0,800,canvas_width,canvas_height,"black")
}

eachStar = []
eachBlade = []
eachDoor = []
eachButton = []
eachWin = []
eachDot = []
eachPatrol = []
patrolData = []
eachBullet=[]
bulletData = []
breakoutBlocks = []
bladeData = []
starsCollected = 0
dotsCollected = 0
blocksCollected = 0

function newStar(x,y) {
    eachStar[eachStar.length] = complexstar(x,y,15,10,5,"gold")
}

function newStar2(x,y,color) {
    eachStar[eachStar.length] = complexstar(x,y,15,10,5,color)
}

function newDot(x,y,size,color) {
    eachDot[eachDot.length] = circle(x,y,size,color)
}

function newDoor(x,y,color) {
    eachDoor[eachDoor.length] = square(x,y,36,color)
}

function newButton(x,y) {
    eachButton[eachButton.length] = complexstar(x,y,10,5,100,"red")
}

function newSpinner2(x,y,color,speed) {
    eachBlade[eachBlade.length] = complexstar(x,y,50,10,4,color)
    if (speed == 0){
        speed = 2
    }
    bladeData[bladeData.length] = speed
}

function newBlade(x,y,color) {
    eachBlade[eachBlade.length] = complexstar(x,y,50,10,4,color)
    bladeData[bladeData.length] = 2
}

function newBlade2(x,y,color,speed) {
    eachBlade[eachBlade.length] = complexstar(x,y,50,10,4,color)
    if (speed == 0){
        speed = 2
    }
    bladeData[bladeData.length] = speed
}

function newSpinner(x,y,color) {
    eachBlade[eachBlade.length] = complexstar(x,y,50,10,4,color)
    bladeData[bladeData.length] = 2
}

function newWin(x,y) {
    eachWin[eachWin.length] = complexstar(x,y,15,10,100,"green")
}

function newPatrol(x1,y1,x2,y2,color) {
    eachPatrol[eachPatrol.length] = complexstar(x1,y1,50,10,4,color)
    patrolData[patrolData.length] = [x1,y1,x2,y2,x1,y1,x2,y2]
}

function newBullet(x1,y1,x2,y2,color) {
    eachBullet[eachBullet.length] = circle(x1,y1,5,color)
    bulletData[bulletData.length] = [x1,y1,x2,y2,x1,y1,x2,y2]
}


function addBreakoutBlocks(numx,numy,color) {
    totalWidth = canvas_width - 40;
    eachBlockWidth = totalWidth / numx;
    eachBlockHeight = 20
    for (y in range (numy)) {
        for (x in range(numx)) {
            breakoutBlocks[breakoutBlocks.length] = rectangle((x * eachBlockWidth),(y * eachBlockHeight), ((parseInt(x) + 1) * eachBlockWidth), ((parseInt(y) + 1) * eachBlockHeight),color)
            breakoutBlocks[breakoutBlocks.length - 1].strokeColor = "white"
            breakoutBlocks[breakoutBlocks.length - 1].position.x += 20
            breakoutBlocks[breakoutBlocks.length - 1].position.y += 20
        }
    }
}

function checkBlocks() {
    for (i in range(breakoutBlocks.length)) {
        if(breakoutBlocks[i].hitTest(ball.position)) {
            breakoutBlocks[i].visible = false
            bounce(ball,"top")
            blocksCollected += 1
            if (blocksCollected == breakoutBlocks.length) {
                displayMessage("WINNER!")
            }
        }
    }
}

function onFrame() {
    for (i in range(eachBlade.length)) {
        eachBlade[i].rotate(bladeData[i])
    }
    for (i in range(patrolSpeed)) {
        for (i in range(eachPatrol.length)) {
            currentx = patrolData[i][4]
            currenty = patrolData[i][5]
            targetx = patrolData[i][6]
            targety = patrolData[i][7]
            if (currentx == targetx && currenty == targety) {
            
                if (targetx == patrolData[i][0]) {
                    targetx = patrolData[i][2]
                } else {
                    targetx = patrolData[i][0]
                }
                if (targety == patrolData[i][1]) {
                    targety = patrolData[i][3]
                } else {
                    targety = patrolData[i][1]
                }
            }
                if (currentx < targetx){
                    currentx += 1
                }
                if (currentx > targetx){
                    currentx -= 1
                }
                if (currenty < targety){
                    currenty += 1
                }
                if (currenty > targety){
                    currenty -= 1
                }
                
            patrolData[i] = [patrolData[i][0],patrolData[i][1],patrolData[i][2],patrolData[i][3],currentx,currenty,targetx,targety]
            
            eachPatrol[i].position.x = currentx
            eachPatrol[i].rotate(3)
            eachPatrol[i].position.y = currenty
            
        }
    }
        for (i in range(bulletSpeed)) {
        for (i in range(eachBullet.length)) {
            currentx = bulletData[i][4]
            currenty = bulletData[i][5]
            targetx = bulletData[i][6]
            targety = bulletData[i][7]
            if (currentx == targetx && currenty == targety) {
            
                currentx = bulletData[i][0]
                currenty = bulletData[i][1]
                
            }
                if (currentx < targetx){
                    currentx += 1
                }
                if (currentx > targetx){
                    currentx -= 1
                }
                if (currenty < targety){
                    currenty += 1
                }
                if (currenty > targety){
                    currenty -= 1
                }
                
            bulletData[i] = [bulletData[i][0],bulletData[i][1],bulletData[i][2],bulletData[i][3],currentx,currenty,targetx,targety]
            
            eachBullet[i].position.x = currentx
            eachBullet[i].position.y = currenty
            
        }
    }
}

function checkStars(event) {
    for (i in range(eachStar.length)) {
        if(eachStar[i].hitTest(event.point) && gameState == 0) {
            eachStar[i].visible = false
            starsCollected += 1
        }
    }
}

function checkDots(event) {
    for (i in range(eachDot.length)) {
        if(eachDot[i].hitTest(event.point) && gameState == 0) {
            eachDot[i].visible = false
            dotsCollected += 1
        }
    }
}

function checkSpinners(event) {
    for (i in range(eachBlade.length)) {
        if(eachBlade[i].hitTest(event.point) && gameState == 0) {
            displayMessage("Game Over!")
        }
    }
}

function checkBlades(event) {
    for (i in range(eachBlade.length)) {
        if(eachBlade[i].hitTest(event.point) && gameState == 0) {
            displayMessage("Game Over!")
        }
    }
}

function checkPatrols(event) {
    for (i in range(eachPatrol.length)) {
        if(eachPatrol[i].hitTest(event.point) && gameState == 0) {
            displayMessage("Game Over!")
        }
    }
}

function checkBullets(event) {
    for (i in range(eachBullet.length)) {
        if(eachBullet[i].hitTest(event.point) && gameState == 0) {
            displayMessage("Game Over!")
        }
    }
}

function checkWin(event,nextlevel) {
    for (i in range(eachWin.length)) {
        if(eachWin[i].hitTest(event.point) && gameState == 0) {
            displayMessage("You collected "+starsCollected+" stars!")
        }
    }
}

function checkDoors(event) {
    for (i in range(eachDoor.length)) {
        if(eachDoor[i].hitTest(event.point) && gameState == 0) {
            displayMessage("Game Over!")
        }
    }
}

function checkButtons(event) {
    for (i in range(eachButton.length)) {
        if(eachButton[i].hitTest(event.point) && gameState == 0) {
            eachButton[i].fillColor = "green"
            eachDoor[i].visible = false
        }
    }
}

function checkMap(event) {
    if (mazeMapLayer.hitTest(event.point)) {
        displayMessage("Game Over!")
    }
}

function addTopBumper(color){
    topBumper = rectangle(0,0,canvas_width,20,color)
}

function addBottomBumper(color){
    bottomBumper = rectangle(0,canvas_height,canvas_width,canvas_height - 20,color)
}

function addLeftBumper(color){
    leftBumper = rectangle(0,0,20,canvas_height,color)
}

function addRightBumper(color){
    rightBumper = rectangle(canvas_width - 20,0,canvas_width,canvas_height,color)
}

function addPaddle(color) {
    breakoutPaddle = rectangle(half_width - 50,canvas_height - 100,half_width + 50,canvas_height - 80,color);
}

function addBall(color) {
    ball = circle(half_width,half_height,10,color)
    ball.direction = 45
}

function bounceOnWalls() {
    if (topBumper.hitTest(ball.position)) {bounce(ball,"top")}
    if (leftBumper.hitTest(ball.position)) {bounce(ball,"left")}
    if (rightBumper.hitTest(ball.position)) {bounce(ball,"right")}
    if (bottomBumper.hitTest(ball.position)) {displayMessage("GAME OVER")}
}

function bounceOnPaddle() {
    if (breakoutPaddle.hitTest(ball.position)) {bounce(ball,"top")}
}

function movePaddle(event) {
    breakoutPaddle.position.x = event.point.x
}

// Converts from degrees to radians.
Math.radians = function(degrees) {
  return degrees * Math.PI / 180;
};
 
// Converts from radians to degrees.
Math.degrees = function(radians) {
  return radians * 180 / Math.PI;
};

function moveForward(sprite,unit) {
    if (sprite.direction == 0){
		sprite.position.y -= 1*unit;
	}
	else if (sprite.direction < 90){
		sprite.position.x += (Math.sin(Math.radians(sprite.direction)))*unit; 
		sprite.position.y -= (Math.cos(Math.radians(sprite.direction)))*unit; 
	}
	else if (sprite.direction == 90){
		sprite.position.x += 1*unit;
	}
	else if (sprite.direction < 180) {
		sprite.position.x += (Math.cos(Math.radians(sprite.direction-90)))*unit; 
		sprite.position.y += (Math.sin(Math.radians(sprite.direction-90)))*unit;
	}
	else if (sprite.direction == 180){
		sprite.position.y += 1*unit;
	}
	else if (sprite.direction < 270) {
		sprite.position.x -= (Math.sin(Math.radians(sprite.direction-180)))*unit; 
		sprite.position.y += (Math.cos(Math.radians(sprite.direction-180)))*unit; 
	}
	else if (sprite.direction == 270){
		sprite.position.x -= 1*unit;
	}
	else {
		sprite.position.x -= (Math.cos(Math.radians(sprite.direction-270)))*unit; 
		sprite.position.y -= (Math.sin(Math.radians(sprite.direction-270)))*unit; 
	}	
}

function bounce(sprite,surface) {
    if (surface == "top") {normal = 0;}
    if (surface == "bottom") {normal = 0;}
    if (surface == "left") {normal = 90;}
    if (surface == "right") {normal = 90;}
    if (surface == "paddle") {normal = 0;}
    sprite.direction = 2 * normal - 180 - sprite.direction
    if (sprite.direction >= 360) {
        sprite.direction -= 360
    }
}

function randomBetween(minimum,maximum) {
    return Math.floor((Math.random() * (maximum - minimum)) + minimum);
}

function input(textstring) {
    return parseFloat(prompt(textstring));
}

function bigHouse(x,y) {
    square(x,y,40,"blue");
}

function mediumHouse(x,y) {
    square(x,y,30,"red");
}

function smallHouse(x,y) {
    square(x,y,20,"green");
}

function mod(x,y) {
    return x % y
}

gameState = 0

function displayMessage(messageText){
    if (gameState == 0) {
        showmessage = new Layer();
        messageBackground = rectangle(0,0,canvas_width,canvas_height,"white");
        //messageBackground.opacity = 0.8;
        messageDetail = text(half_width,half_height,messageText,"black");
        gameState = 1;
    }
}

function startLevel(x,y) {
    startButton = circle(x,y,20,"silver");
    startButton.visible = false;
}

pencolor = "black";

snowflakes = [];

function addSnowflake(size) {
    snowflakes[snowflakes.length] = new Layer();
    for (i in range (6)) {
        snowflakeSpike = new Layer();
            a = triangle(300,300,20,"white");
            a.scale(1,5);
            b = triangle(300,450,20,"white");
            b.scale(1,5);
            b.opacity = 0;
            b.rotate(180);
            c = triangle(300,300,30,"white");
            c.rotate(180);
            d = triangle(300,290,30,"white");
            d.scale(1,0.5);
            e = triangle(300,340,30,"white");
            e.rotate(180);
        snowflakeSpike.rotate(i * 60);
        snowflakes[snowflakes.length - 1].addChild(snowflakeSpike);
    }
    snowflakes[snowflakes.length - 1].scale(size/150)
    snowflakes[snowflakes.length - 1].position.x = randomBetween(0,canvas_width)
    snowflakes[snowflakes.length - 1].position.y = randomBetween(-(size * 2),canvas_height)
    snowflakes[snowflakes.length - 1].opacity = 0.5
    stop = new Layer()
}

function moveSnowflakes() {
    for (i in range(snowflakes.length)) {
        snowflakes[i].position.y += 2
        snowflakes[i].rotate(1)
        if (snowflakes[i].position.y > (canvas_height + 100)) {
            snowflakes[i].position.y = -(200)
            snowflakes[i].position.x = randomBetween(0,canvas_width)
        }
    }
}

function moveObject(event,objectName) {
    if(objectName.hitTest(event.point)) {
        objectName.position.x = event.point.x
        objectName.position.y = event.point.y
    }
}


function head(xpos,ypos) {
eachhead = new Layer()

hair(280,220,-30)
hair(295,220,-10)
hair(315,220,200)

semicircle(300,300,50,"white")
shape.scale(1,1.5)
semicircle(300,350,50,"white")
shape.scale(1.5,1)
semicircle(300,435,50,"white")
shape.rotate(180)
shape.scale(1.5,2.5)
eachhead.position.x = xpos
eachhead.position.y = ypos

return(eachhead)
}

function carrot(xpos,ypos) {
eachcarrot = new Layer()
semicircle(340,330,15,"#e35e03")
semicircle(340,366,15,"#e35e03")
shape.rotate(180)
shape.scale(1,4)
eachcarrot.rotate(-90)
eachcarrot.scale(1.3)
eachcarrot.position.x = xpos
eachcarrot.position.y = ypos
return(eachcarrot)
}

function mouth(xpos,ypos) {
eachmouth = new Layer()
circle(300,350,20,"#262831")
shape.scale(2.5,1)
semicircle(300,400,25,"#262831")
shape.rotate(180)
shape.scale(1,2)
rectangle(290,350,310,380,"silver")
rectangle(285,350,315,375,"silver")
circle(290,375,5,"silver") 
circle(310,375,5,"silver") 
rectangle(299.5,350,300.5,385,"#262831")
circle(300,345,20,"white")
shape.scale(3,1)
circle(340,360,10,"#262831")
circle(345,355,12,"white")
circle(260,360,10,"#262831")
circle(255,355,12,"white")
eachmouth.scale(1.2)
eachmouth.position.x = xpos
eachmouth.position.y = ypos
return(eachmouth)
}

function eye(xpos,ypos) {
eacheye = new Layer()
circle(280,300,20,"white")
shape.strokeColor = "#262831"
circle(280,305,10,"#262831")
circle(285,302,2,"white")
eyebrow(280,280)
eacheye.position.x = xpos
eacheye.position.y = ypos
return(eacheye)
}

function snowball(xpos,ypos,size) {
eachsnowball = new Layer() 
circle(xpos,ypos,size,"white")
shape.scale(1,.75)
return(eachsnowball)
}

function body(xpos,ypos) {
    eachbody = new Layer()
    snowball(xpos,ypos - 40,50)
    snowball(xpos,ypos + 40,90)
    return(eachbody)
}

function body2(xpos,ypos) {
    eachbody = new Layer()
    snowball(xpos,ypos - 40,90)
    snowball(xpos,ypos + 40,50)
    return(eachbody)
}


function foot(xpos,ypos) {
    snowball(xpos,ypos,30)
}


function coal(xpos,ypos) {
return(heptagon(xpos,ypos,15,"#262831"))
}

function arm(x,y,rotation) {
textval = new PointText(new Point(x, y));
textval.justification = "center";
textval.fillColor = "#4d260c";
textval.content = "˦";    
textval.fontSize = 100;
textval.fontWeight = "bold";
textval.fontFamily = "cursive";
textval.scale(1,1)
textval.rotate(rotation)
return textval;
}

function eyebrow(x,y) {
textval = new PointText(new Point(x, y));
textval.justification = "center";
textval.fillColor = "#262831";
textval.content = ")";    
textval.fontSize = 30;
textval.fontWeight = "bold";
textval.fontFamily = "cursive";
textval.scale(1,1)
textval.rotate(-90)
return textval;
}

function hair(x,y,rotation) {
textval = new PointText(new Point(x, y));
textval.justification = "center";
textval.fillColor = "#262831";
textval.content = ")";    
textval.fontSize = 30;
textval.fontFamily = "cursive";
textval.scale(1,2)
textval.rotate(rotation)
return textval;
}

function bird() {
    newbird = new Layer()
    circle(half_width,half_height,50,"black").scale(1,.7)
    circle(half_width,half_height,46,"orange").scale(1,.7)
    circle(half_width+2,half_height-11,46,"yellow").scale(1,.5).scale(0.9)
    circle(half_width+45,half_height+5,25,"black").scale(1,.5)
    circle(half_width+45,half_height+5,21,"red").scale(1,.5)
    circle(half_width+30,half_height-15,20,"black").scale(1,1)
    circle(half_width+30,half_height-15,16,"white").scale(1,1)
    circle(half_width+35,half_height-15,8,"black").scale(1,1)
    circle(half_width-30,half_height-5,25,"black").scale(1,1)
    circle(half_width-30,half_height-5,21,"yellow").scale(1,1)
    circle(half_width-30,half_height-10,21,"white").scale(1,.8).scale(0.9)
    newbird.scale(0.5)
    return newbird
}

function pipe() {
    newpipe = new Layer()
    
    rectangle(half_width-62,half_height-120,half_width+62,-500,"black")
    rectangle(half_width-62,half_height+120,half_width+62,canvas_height+500,"black")
    rectangle(half_width-60,half_height-120,half_width+60,-500,"green")
    rectangle(half_width-60,half_height+120,half_width+60,canvas_height+500,"green")
    
    rectangle(half_width-72,half_height-98,half_width+72,half_height-152,"black")
    rectangle(half_width-72,half_height+98,half_width+72,half_height+152,"black")
    rectangle(half_width-70,half_height-100,half_width+70,half_height-150,"forestgreen")
    rectangle(half_width-70,half_height+100,half_width+70,half_height+150,"forestgreen")
    
    return newpipe
}

function onMouseDown(event) {
    if (gameState == 0) {
        //displayMessage("Move the objects by changing the coordinates in brackets in the code")
    } else {
        if(startButton.hitTest(event.point)) {
            gameState = 0
            messageBackground.visible = false
            messageDetail.visible = false
            for (i in range(eachButton.length)) {
                eachButton[i].fillColor = "red"
                eachDoor[i].visible = true
            }
        }
    }
}

//function onMouseMove(event) {
//    checkButtons(event);
//    checkDoors(event);
//    checkSpinners(event);
//    checkWin(event);
//    checkStars(event);
//    checkMap(event);
//    checkPatrols(event);
//}

patrolSpeed = 2
bulletSpeed = 5

<?php
echo "helper();";
echo "canvas('white');";
$code =$_POST["code"];
echo $code;
?>

</script>

</head>
<body class = gradient>
  
<div class = puppy><a href = index.php><font color = white>>> C O D E <b>P U P P Y<font color = #86c232> <?php echo strtoupper($_GET["env"]); ?> DEVELOPMENT ENVIRONMENT</font></b></a></div>

<div class = "half">

<form method="post" enctype="multipart/form-data">
<textarea id="code" name="code" spellcheck="false" onKeyDown="if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'    '+v.substring(e);this.selectionStart=this.selectionEnd=s+4;return false;}">
<?php

if ($_FILES['fileToUpload']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) { 

    $lines = file($_FILES['fileToUpload']['tmp_name']);

    foreach ($lines as $line_num => $line) {
        echo htmlspecialchars($line);
    }
} else {
    if(isset($_POST['code']))
    {
        echo $_POST['code'];
    } else {
       
echo '';
        }
        
        
    }


?>
</textarea>
<input type="submit" value="▶️ RUN CODE" name="submit" class="button focusbutton" >
</form>

<form method="post" enctype="multipart/form-data">
<textarea id="dlcode" name="dlcode" rows="30" cols="50" style="display:none;">
<?php

if ($_FILES['fileToUpload']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) { 
    $lines = file($_FILES['fileToUpload']['tmp_name']);
    foreach ($lines as $line_num => $line) {
        echo htmlspecialchars($line);
    }
} else {
    if(isset($_POST['code']))
    {
        echo $_POST['code'];
    }
}

?>
</textarea>
<input type="submit" value="💾 SAVE FILE" name="submit" class="button">
</form>

<form method="post" enctype="multipart/form-data">
  <input type="file" name="fileToUpload" id="fileToUpload" onchange="javascript:this.form.submit();" style="display:none;">
  <label for="fileToUpload" class="button labelbutton">📂 OPEN FILE</label>
</form>

</div>
 
<div class = "half">
<canvas id="paperscriptCanvas"></canvas>
</div>

</body>
</html>