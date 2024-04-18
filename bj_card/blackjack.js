import React, { useState, useEffect } from 'react';

function BlackjackGame() {
  const [deck, setDeck] = useState([]);
  const [playerHand, setPlayerHand] = useState([]);
  const [dealerHand, setDealerHand] = useState([]);
  const [playerHandValue, setPlayerHandValue] = useState(0);
  const [dealerHandValue, setDealerHandValue] = useState(0);
  const [result, setResult] = useState('');

  useEffect(() => {
    // カードの配列を作成
    const diamonds = [];
    const hearts = [];
    const clubs = [];
    const spades = [];

    for (let i = 1; i <= 13; i++) {
      diamonds.push(`d${i < 10 ? '0' + i : i}.png`);
      hearts.push(i === 7 ? 'h07.png' : `h${i < 10 ? '0' + i : i}.png`);
      clubs.push(`c${i < 10 ? '0' + i : i}.png`);
      spades.push(`s${i < 10 ? '0' + i : i}.png`);
    }

    const newDeck = [...diamonds, ...hearts, ...clubs, ...spades];
    setDeck(newDeck);

    // 初期手札を配布
    const initialPlayerHand = [selectRandomCard(), selectRandomCard()];
    const initialDealerHand = [selectRandomCard(), selectRandomCard()];
    setPlayerHand(initialPlayerHand);
    setDealerHand(initialDealerHand);

    // 初期手札の合計値を計算
    setPlayerHandValue(calculateHandValue(initialPlayerHand));
    setDealerHandValue(calculateHandValue(initialDealerHand));
  }, []);

  // カードをランダムに選ぶ関数
  const selectRandomCard = () => {
    const randomIndex = Math.floor(Math.random() * deck.length);
    return deck[randomIndex];
  };

  // 手札の合計値を計算する関数
  const calculateHandValue = (hand) => {
    let totalValue = 0;
    let numberOfAces = 0;

    for (let i = 0; i < hand.length; i++) {
      const cardValue = parseInt(hand[i].substring(1, 3), 10);
      totalValue += cardValue === 1 ? 11 : Math.min(cardValue, 10);

      if (cardValue === 1) {
        numberOfAces++;
      }
    }

    while (totalValue > 21 && numberOfAces > 0) {
      totalValue -= 10;
      numberOfAces--;
    }

    return totalValue;
  };

  // ゲームの結果を判定する関数
  const checkResult = () => {
    if (playerHandValue === 21 && playerHand.length === 2) {
      setResult('プレイヤーがブラックジャック！');
    } else if (dealerHandValue === 21 && dealerHand.length === 2) {
      setResult('ディーラーがブラックジャック！');
    } else if (playerHandValue > 21) {
      setResult('プレイヤーがBUST！');
    } else if (dealerHandValue > 21) {
      setResult('ディーラーがBUST！');
    } else if (playerHandValue > dealerHandValue) {
      setResult('プレイヤーの勝利！');
    } else if (dealerHandValue > playerHandValue) {
      setResult('ディーラーの勝利！');
    } else {
      setResult('引き分け！');
    }
  };

  useEffect(() => {
    checkResult();
  }, [playerHandValue, dealerHandValue]);

  return (
    <div>
      <h1>Blackjack</h1>
      <div>
        <h2>プレイヤーの手札</h2>
        <div>{playerHand.map((card, index) => <img key={index} src={`card/${card}`} alt={`card${index}`} className="card" />)}</div>
        <p>合計値: {playerHandValue}</p>
      </div>
      <div>
        <h2>ディーラーの手札</h2>
        <div>{dealerHand.map((card, index) => <img key={index} src={`card/${card}`} alt={`card${index}`} className="card" />)}</div>
        <p>合計値: {dealerHandValue}</p>
      </div>
      <p>{result}</p>
    </div>
  );
}

export default BlackjackGame;
