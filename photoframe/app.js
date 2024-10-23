const video = document.getElementById('camera');
const canvas = document.getElementById('canvas');
const captureIcon = document.getElementById('capture-icon');
const context = canvas.getContext('2d');
const deviceSelect = document.getElementById('deviceSelect'); // カメラデバイス選択用のセレクトボックス

// デバイスのピクセル比を取得
const devicePixelRatio = window.devicePixelRatio || 1;

let frameImg = new Image();
frameImg.src = 'frame.png';  // フレーム画像のソースを設定

// フレーム画像が読み込まれたか確認
frameImg.onload = () => {
  console.log('Frame image loaded successfully.');
};

// カメラデバイスをリスト表示する
navigator.mediaDevices.enumerateDevices().then(devices => {
  const videoDevices = devices.filter(device => device.kind === 'videoinput');
  videoDevices.forEach(device => {
    const option = document.createElement('option');
    option.value = device.deviceId;
    option.text = device.label || `Camera ${deviceSelect.length + 1}`;
    deviceSelect.appendChild(option);
  });

  // デフォルトで外カメラを使用する
  startCameraWithFacingMode('environment');
});

// カメラの切り替えが行われた時にカメラを再起動
deviceSelect.addEventListener('change', () => {
  startCamera(deviceSelect.value);
});

// 外カメラを開始するための関数
function startCameraWithFacingMode(facingMode) {
  const constraints = {
    video: {
      facingMode: { exact: facingMode } // 'environment' を指定して外カメラを選択
    }
  };

  // WebRTCでカメラを起動
  navigator.mediaDevices.getUserMedia(constraints)
    .then(stream => {
      video.srcObject = stream;
      video.onloadedmetadata = () => {
        video.play();
        // 画面全体に対応するための関数を呼び出し
        resizeCanvasToCover();
        // フレームのリアルタイム合成開始
        drawFrameOnVideo();
      };
    })
    .catch(error => {
      console.error('カメラの起動に失敗しました:', error);
    });
}

// カメラを開始する関数（デバイスID指定）
function startCamera(deviceId) {
  const constraints = {
    video: {
      deviceId: { exact: deviceId }
    }
  };

  // WebRTCでカメラを起動
  navigator.mediaDevices.getUserMedia(constraints)
    .then(stream => {
      video.srcObject = stream;
      video.onloadedmetadata = () => {
        video.play();
        // 画面全体に対応するための関数を呼び出し
        resizeCanvasToCover();
        // フレームのリアルタイム合成開始
        drawFrameOnVideo();
      };
    })
    .catch(error => {
      console.error('カメラの起動に失敗しました:', error);
    });
}

// Canvasを全画面にしてカバーする関数
function resizeCanvasToCover() {
  const videoAspectRatio = video.videoWidth / video.videoHeight;
  const windowAspectRatio = window.innerWidth / window.innerHeight;

  let renderWidth, renderHeight;

  // カメラ映像をウィンドウ全体に表示するために、アスペクト比を維持しつつカバー
  if (windowAspectRatio > videoAspectRatio) {
    // ウィンドウが横長の場合、ビデオの幅をウィンドウに合わせ、高さをトリミング
    renderWidth = window.innerWidth;
    renderHeight = window.innerWidth / videoAspectRatio;
  } else {
    // ウィンドウが縦長の場合、ビデオの高さをウィンドウに合わせ、幅をトリミング
    renderHeight = window.innerHeight;
    renderWidth = window.innerHeight * videoAspectRatio;
  }

  // Canvasのピクセルサイズをデバイスのピクセル比に基づいて拡大
  canvas.width = window.innerWidth * devicePixelRatio;
  canvas.height = window.innerHeight * devicePixelRatio;

  // Canvasのスタイルサイズをウィンドウにフィットさせる
  canvas.style.width = `${window.innerWidth}px`;
  canvas.style.height = `${window.innerHeight}px`;

  // スケーリングを適用
  context.scale(devicePixelRatio, devicePixelRatio);

  // トリミングするためのオフセットを計算
  const offsetX = (renderWidth - window.innerWidth) / 2;
  const offsetY = (renderHeight - window.innerHeight) / 2;

  // Canvasにカメラ映像を描画（トリミング）
  context.clearRect(0, 0, canvas.width, canvas.height);
  context.drawImage(video, -offsetX, -offsetY, renderWidth, renderHeight);
}

// フレームをリアルタイムでビデオ映像に合成
function drawFrameOnVideo() {
  // カメラ映像をウィンドウ全体に描画
  resizeCanvasToCover();

  // フレーム画像のサイズと位置を設定（カメラの縦サイズの50%を高さに設定）
  const frameHeight = window.innerHeight * 0.5; // カメラ映像の高さの50%をフレームの高さに設定
  const frameWidth = frameImg.width * (frameHeight / frameImg.height); // アスペクト比を維持して幅を計算
  const frameX = (window.innerWidth - frameWidth) / 2; // フレームを横方向で中央に配置
  const frameY = window.innerHeight - frameHeight; // フレームをCanvasの下部に配置

  // フレーム画像をビデオ映像の上に描画
  context.drawImage(frameImg, frameX, frameY, frameWidth, frameHeight);

  // 次のフレームを描画
  requestAnimationFrame(drawFrameOnVideo);
}

// 写真を撮るアイコンのクリックイベント
captureIcon.addEventListener('click', () => {
  // 現在表示されているCanvasの内容を画像として保存
  const imageData = canvas.toDataURL('image/png');
  
  // デバッグ用：新しいウィンドウでキャンバス内容を表示
  const newWindow = window.open('', '_blank');
  const newImage = newWindow.document.createElement('img');
  newImage.src = imageData;
  newWindow.document.body.appendChild(newImage);

  // 画像を保存
  const link = document.createElement('a');
  link.href = imageData;
  link.download = 'photo.png';
  link.click();
});

// ウィンドウサイズが変わったときにCanvasのサイズを再調整
window.addEventListener('resize', resizeCanvasToCover);
