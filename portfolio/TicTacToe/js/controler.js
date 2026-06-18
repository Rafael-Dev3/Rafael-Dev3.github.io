// Controller
console.log("connected");

// Game Logic
for (let i = 0; i < boxes.length; i++) {
  let box = boxes[i];
  let boxtext = box.querySelector(".boxtext");

  box.addEventListener("click", function () {
    if (boxtext.innerHTML === "" && !gameOver) {
      boxtext.innerHTML = turn;
      checkWin();
      if (!gameOver) {
        turn = changeTurn();
        document.querySelector(".info").innerHTML = "Turn for " + turn;
      }
    }
  });
}

resetButton.addEventListener("click", reset);
