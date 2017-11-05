"use strict";

const canvas = document.getElementById("myCanvas");
const ctx = canvas.getContext("2d");

/** 游戏区域*/
const WIDTH = 360;
const HEIGHT = 640;
/** 帧率*/
const FRAME_INTERVAL = 33;
/** 单身狗速度*/
const DOG_SPEED_SINGLE = 4;
/** 单身狗路, 哇塞单身狗有3条路走*/
const DOG_ROAD = 3;
/** 狗数量*/
const DOG_NUM = 8;
/** 倒计时*/
let countDown = 1;
/** 拯救数量*/
let saveCount = 0;
/** 总数量*/
let totalCount = 0;

const SPRITE_WIDTH = 100;

let splashImg = new Image();
let textArrayIndex = 0;
let textIndex = 0;

let logoImg = new Image();
let dogImg = new Image();

logoImg.src = "http://dashidan.com/img/game/save_the_single_dog/dashidan_log.jpg";
let loadFinish = false;
logoImg.onload = function () {
    dogImg.src = "http://dashidan.com/img/game/save_the_single_dog/dog.jpg";
    dogImg.onload = function () {
        loadFinish = true;
    };
};

ctx.fillStyle = "#000000";
ctx.fillRect(0, 0, WIDTH, HEIGHT);

let i;
let img;

const dogOnTheRoad = [];

let gameState = 1;
const GAME_STATE_SPLASH = 1;
const GAME_STATE_INFO = 2;
const GAME_STATE_COUNT_DOWN = 3;
const GAME_STATE_GAMING = 4;
const GAME_STATE_GAME_OVER = 5;

function render() {
    if (!loadFinish) {
        render();
    }

    switch (gameState) {
        case GAME_STATE_SPLASH:
            renderSlash();
            break;
        case GAME_STATE_INFO:
            renderText();
            break;
        case GAME_STATE_GAMING:
            renderGame();
            break;
        case GAME_STATE_COUNT_DOWN:
            renderCountDown();
            break;
        case GAME_STATE_GAME_OVER:
            renderGameOver();
            break;
    }

    ctx.drawImage(logoImg, 0, 546);
    gameStep++;
}

let gameStep = 0;
let isDrawSplash = false;

function renderSlash() {
    console.log("-----renderSlash--------");
    if (!isDrawSplash) {
        splashImg = new Image();
        splashImg.src = "http://dashidan.com/img/game/save_the_single_dog/splash.jpg";
        splashImg.onload = function () {
            ctx.drawImage(splashImg, 0, 0);
        };
        isDrawSplash = true;
    }

    if (gameStep > 100) {
        ctx.clearRect(0, 0, WIDTH, HEIGHT);

        if (ctx.globalAlpha > 0) {
            ctx.globalAlpha -= 0.01;
        }
        ctx.drawImage(splashImg, 0, 0);
        if (gameStep > 200) {
            updateGameState(GAME_STATE_INFO)
        }
    }
}

function renderText() {
    console.log("-----renderText--------");

    let textArr = [];
    // textArr.push("一年一度的光棍节又到了!");
    // textArr.push("单身狗表示受到一万点伤害");
    // textArr.push("所以要为单身狗做点什么");
    // textArr.push("拯救单身狗!");
    // textArr.push("恩爱狗群中救出单身狗!");

    textArr.push("开始!");

    if (gameStep % 5 == 1) {
        if (textArr[textArrayIndex]) {
            if (textIndex >= textArr[textArrayIndex].length) {
                textArrayIndex++;
                textIndex = 0;
            } else {
                ctx.fillStyle = "#000000";
                ctx.font = "20px 微软雅黑";
                ctx.fillText(textArr[textArrayIndex].substr(textIndex, 1), 30 * textIndex,
                             100 + textArrayIndex * 30 + 100);
                textIndex++;
            }
        } else {
            updateGameState(GAME_STATE_COUNT_DOWN)
        }
    }
}

function renderCountDown() {
    console.log("-----renderCountDown--------");
    if (gameStep % 30 == 1) {
        if (countDown > 0) {
            ctx.fillStyle = "#666666";
            ctx.fillRect(0, 0, WIDTH, HEIGHT);
            ctx.fillStyle = "#000000";
            ctx.font = "100px 微软雅黑";
            ctx.fillText(countDown + "", 160, 300);
            countDown--;
        } else {
            updateGameState(GAME_STATE_GAMING)
        }
    }
}

function renderGame() {
    if (gameStep % FRAME_INTERVAL * 3 == 0) {
        let dogIndex = parseInt(Math.random() * DOG_NUM);
        let roadIndex = parseInt(Math.random() * DOG_ROAD);
        dogOnTheRoad.push(new DogInfo(dogIndex, roadIndex, 0, 0));
        totalCount++;
    }

    ctx.fillStyle = "#666666";
    ctx.fillRect(0, 0, WIDTH, HEIGHT);

    for (let i = 0; i < dogOnTheRoad.length; i++) {
        dogOnTheRoad[i].posX = 20 + dogOnTheRoad[i].roadIndex * 110;
        let addY = (DOG_SPEED_SINGLE + parseInt(totalCount / 10));
        dogOnTheRoad[i].posY += addY;
        console.log("addY : " + addY + " dogOnTheRoad[i].posY " + dogOnTheRoad[i].posY);
        ctx.drawImage(dogImg, dogOnTheRoad[i].dogIndex * SPRITE_WIDTH, 0, SPRITE_WIDTH, SPRITE_WIDTH,
                      dogOnTheRoad[i].posX, dogOnTheRoad[i].posY, SPRITE_WIDTH, SPRITE_WIDTH);
    }

    ctx.fillStyle = "#008ace";
    ctx.fillRect(0, 0, WIDTH, 30);
    ctx.fillStyle = "#ffffff";
    ctx.font = "20px 微软雅黑";
    ctx.fillText("拯救单身狗数量: ", 90, 20);
    ctx.fillStyle = "#00ff00";
    ctx.font = "20px 微软雅黑";
    ctx.fillText(saveCount + "", 240, 20);
}

function renderGameOver() {
    ctx.fillStyle = "#000000";
    ctx.fillRect(0, 0, WIDTH, HEIGHT);
    ctx.fillStyle = "#ffffff";
    ctx.font = "40px 微软雅黑";
    ctx.fillText("共拯救单身狗", 60, 260);
    ctx.fillStyle = "#00ff00";
    ctx.font = "40px 微软雅黑";
    ctx.fillText(saveCount + "", 160, 300);
    ctx.fillStyle = "#ffffff";
    ctx.font = "40px 微软雅黑";
    ctx.fillText("只!", 160, 340);
}

function updateGameState(state) {
    ctx.globalAlpha = 1;

    gameStep = 0;
    gameState = state;
}

class DogInfo {

    constructor(dogIndex, roadIndex, posX, posY) {
        this._dogIndex = dogIndex;
        this._roadIndex = roadIndex;
        this._posX = posX;
        this._posY = posY;
    }

    get dogIndex() {
        return this._dogIndex;
    }

    get roadIndex() {
        return this._roadIndex;
    }

    set posX(value) {
        this._posX = value;
    }

    get posX() {
        return this._posX;
    }

    get posY() {
        return this._posY;
    }

    set posY(value) {
        this._posY = value;
    }
}

window.setInterval(render, FRAME_INTERVAL);

canvas.addEventListener('click', function (event) {
    if (gameState != GAME_STATE_GAMING) {
        return;
    }

    console.log("ev " + event);
    let x, y;
    if (event.layerX || event.layerX == 0) {
        x = event.layerX;
        y = event.layerY;
    } else if (event.offsetX || event.offsetX == 0) { // Opera
        x = event.offsetX;
        y = event.offsetY;
    }
    console.log("ev " + event + " x " + x + " y " + y);

    for (let i = 0; i < dogOnTheRoad.length; i++) {
        if (dogOnTheRoad[i].dogIndex < 4) {
            if (x >= dogOnTheRoad[i].posX
                && x <= dogOnTheRoad[i].posX + 100
                && y >= dogOnTheRoad[i].posY
                && y <= dogOnTheRoad[i].posY + 100) {
                saveCount++;
                /** 移除单身狗*/
                dogOnTheRoad.splice(i, 1);
                return;
            }
        } else {
            /** 点中恩爱狗*/
        }
    }

    updateGameState(GAME_STATE_GAME_OVER)
});

