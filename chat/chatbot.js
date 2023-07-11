class Chatbox {
  constructor() {
    this.args = {
      openButton: document.querySelector('.chatbox__button'),
      chatBox: document.querySelector('.chatbox__support'),
      sendButton: document.querySelector('.send__button'),
      chatMessages: document.querySelector('.chatbox__messages')
    };

    this.state = false;
    this.messages = [];
  }

  display() {
    const { openButton, chatBox, sendButton } = this.args;

    openButton.addEventListener('click', () => this.toggleState(chatBox));

    sendButton.addEventListener('click', () => this.onSendButton(chatBox));

    const node = chatBox.querySelector('input');
    node.addEventListener('keyup', ({ key }) => {
      if (key === 'Enter') {
        this.onSendButton(chatBox);
      }
    });
  }

  toggleState(chatbox) {
    this.state = !this.state;

    // Show or hide the box
    if (this.state) {
      chatbox.classList.add('chatbox--active');
    } else {
      chatbox.classList.remove('chatbox--active');
    }
  }

  onSendButton(chatbox) {
    const textField = chatbox.querySelector('input');
    const text = textField.value;
    if (text === '') {
      return;
    }
  
    const isGoToCommand = text.toLowerCase().startsWith('go to');
    if (isGoToCommand) {
      const pageName = text.substr(6).trim().toLowerCase();
      this.navigateToPage(pageName);
    } else {
      const userMsg = { name: 'User', message: text };
      this.messages.push(userMsg);
      this.updateChatText();
  
      fetch("chat/process_query.php?query=" + text)
        .then((response) => response.text())
        .then((response) => {
          const samMsg = { name: 'Sam', message: response };
          this.messages.push(samMsg);
  
          // Speak chatbot response
          computerSpeech(response);
  
          this.updateChatText();
          textField.value = '';
        })
        .catch((error) => {
          console.error('Error:', error);
          this.updateChatText();
          textField.value = '';
        });
    }
  }
  

  navigateToPage(pageName) {
    let url = '';
    switch (pageName) {
      case 'home':
        url = 'index.php';
        break;
      case 'movies':
        url = 'movies_events.php';
        break;
      case 'login':
        url = 'login.php';
        break;
      case 'register':
        url = 'registration.php'
        break;
      default:
        // Page not found, handle accordingly
        return;
    }
    window.location.href = url;
  }

  updateChatText() {
    const { chatMessages } = this.args;

    let html = '';
    for (let i = this.messages.length - 1; i >= 0; i--) {
      const item = this.messages[i];
      if (item.name === 'Sam') {
        html += '<div class="messages__item messages__item--visitor">' + item.message + '</div>';
      } else {
        html += '<div class="messages__item messages__item--operator">' + item.message + '</div>';
      }
    }

    chatMessages.innerHTML = html;

    // Scroll to the bottom of the chatbox
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }

}

const but=document.querySelector(".myy");
but.addEventListener("click", handleclick);
function handleclick(){
  const button = document.querySelector(".myy");

const SpeechRecognition =
  window.SpeechRecognition || window.webkitSpeechRecognition;

const recognition = new SpeechRecognition();

recognition.onstart = function() {
  console.log("Speech Recognition started!");
};

recognition.onresult = function(event) {
  console.log(event);
  const spokenWords = event.results[event.results.length - 1][0].transcript;
  console.log("Spoken words are:", spokenWords);

  // Display spoken words in chatbox
  const userMsg = { name: 'User', message: spokenWords };
  chatbox.messages.push(userMsg);
  chatbox.updateChatText();

  computerSpeech(spokenWords);
};

function computerSpeech(words) {
  const speech = new SpeechSynthesisUtterance();
  speech.lang = "en-US";
  speech.pitch = 0.9;
  speech.volume = 1;
  speech.rate = 1;

  determineWords(speech, words);

  // Speak the response
  window.speechSynthesis.speak(speech);
}


function determineWords(speech, words) {
  const text = words.toLowerCase().replace(/[^\w\s]/g, '');

  if (text) {
    const t = text.replace(/[^\w\s]/g, '');
    const isGoToCommand = t.toLowerCase().startsWith('go to');
    if (isGoToCommand) {
      const pageName = t.substr(6).trim().toLowerCase();
      chatbox.navigateToPage(pageName);
    } else {
      fetch("chat/process_query.php?query=" + t)
        .then((response) => response.text())
        .then((response) => {
          const samMsg = { name: 'Sam', message: response };
          chatbox.messages.push(samMsg);

          // Set the speech text
          speech.text = response;

          // Speak the response
          window.speechSynthesis.speak(speech);

          chatbox.updateChatText();

          textField.value = '';
        })
        .catch((error) => {
          console.error('Error:', error);
          chatbox.updateChatText();
          textField.value = '';
        });
    }
  } else {
    const response = "Sorry, I didn't catch that. Could you please repeat?";
    const samMsg = { name: 'Sam', message: response };
    chatbox.messages.push(samMsg);

    // Set the speech text
    speech.text = response;

    // Speak the response
    window.speechSynthesis.speak(speech);

    chatbox.updateChatText();
  }
}


button.addEventListener("click", function() {
  recognition.start();
});

}
const chatbox = new Chatbox();
chatbox.display();
