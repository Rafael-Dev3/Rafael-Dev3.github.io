// Model
let turn = "X";
let gameOver = false;

// Function to change the turn
function changeTurn() {
  if (turn === "X") {
    return "O";
  } else {
    return "X";
  }
}


// Function to check if win condition is met
function checkWin() {
  let boxtexts = document.querySelectorAll(".boxtext");

  //if statements for win condition
  //horizontal winconditions
  //wincondition 1
  if (
    boxtexts[0].innerHTML === boxtexts[1].innerHTML &&
    boxtexts[1].innerHTML === boxtexts[2].innerHTML &&
    boxtexts[0].innerHTML !== ""
  ) {
    document.querySelector(".info").innerHTML = boxtexts[0].innerHTML + " Congratulations, u win absolutely nothing :D with absolutely nothing, u can do ABSOLUTELY nothing,";
    gameOver = true;
  }
  //second win condition
  if (
    boxtexts[3].innerHTML === boxtexts[4].innerHTML &&
    boxtexts[4].innerHTML === boxtexts[5].innerHTML &&
    boxtexts[3].innerHTML !== ""
  ) {
    document.querySelector(".info").innerHTML = boxtexts[3].innerHTML + " Congratulations, u win absolutely nothing :D with absolutely nothing, u can do ABSOLUTELY nothing,";
    gameOver = true;
  }
  //3rd wincondition
  if (
    boxtexts[6].innerHTML === boxtexts[7].innerHTML &&
    boxtexts[7].innerHTML === boxtexts[8].innerHTML &&
    boxtexts[6].innerHTML !== ""
  ) {
    document.querySelector(".info").innerHTML = boxtexts[6].innerHTML + " Congratulations, u win absolutely nothing :D with absolutely nothing, u can do ABSOLUTELY nothing,";
    gameOver = true;
  }
  //downwards
  //wincondition one
  if (
    boxtexts[0].innerHTML === boxtexts[3].innerHTML &&
    boxtexts[3].innerHTML === boxtexts[6].innerHTML &&
    boxtexts[0].innerHTML !== ""
  ) {
    document.querySelector(".info").innerHTML = boxtexts[0].innerHTML + " Congratulations, u win absolutely nothing :D with absolutely nothing, u can do ABSOLUTELY nothing,";
    gameOver = true;
  }
  //second wincondition
  if (
    boxtexts[1].innerHTML === boxtexts[4].innerHTML &&
    boxtexts[4].innerHTML === boxtexts[7].innerHTML &&
    boxtexts[1].innerHTML !== ""
  ) {
    document.querySelector(".info").innerHTML = boxtexts[1].innerHTML + " Congratulations, u win absolutely nothing :D with absolutely nothing, u can do ABSOLUTELY nothing,";
    gameOver = true;
  }
  //third wincondition
  if (
    boxtexts[2].innerHTML === boxtexts[5].innerHTML &&
    boxtexts[5].innerHTML === boxtexts[8].innerHTML &&
    boxtexts[2].innerHTML !== ""
  ) {
    document.querySelector(".info").innerHTML = boxtexts[2].innerHTML + " Congratulations, u win absolutely nothing :D with absolutely nothing, u can do ABSOLUTELY nothing,";
    gameOver = true;
  }
  //diagonals
  // firsrt wincondition
  if (
    boxtexts[0].innerHTML === boxtexts[4].innerHTML &&
    boxtexts[4].innerHTML === boxtexts[8].innerHTML &&
    boxtexts[0].innerHTML !== ""
  ) {
    document.querySelector(".info").innerHTML = boxtexts[0].innerHTML + " Congratulations, u win absolutely nothing :D with absolutely nothing, u can do ABSOLUTELY nothing,";
    gameOver = true;
  }
  if (
    boxtexts[2].innerHTML === boxtexts[4].innerHTML &&
    boxtexts[4].innerHTML === boxtexts[6].innerHTML &&
    boxtexts[2].innerHTML !== ""
  ) {
    document.querySelector(".info").innerHTML = boxtexts[2].innerHTML + " Congratulations, u win absolutely nothing :D with absolutely nothing, u can do ABSOLUTELY nothing,";
    gameOver = true;
  }
  //draw msg
  let filled = true;
  for (let i = 0; i < boxtexts.length; i++) {
    if (boxtexts[i].innerHTML === "") {
      filled = false;
      
    }
  }
  if (filled && !gameOver) {
    document.querySelector(".info").innerHTML = "Draw! No one wins";
    gameOver = true;
  }
}

function reset(){
  let boxtexts = document.querySelectorAll(".boxtext");
  for (let i = 0; i < boxtexts.length; i++) {
    boxtexts[i].innerHTML = "";
  }
  turn = "X";
  gameOver = false;
  document.querySelector(".info").innerHTML = "Turn for " + turn;
}
