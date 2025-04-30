<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المساعد القانوني السعودي</title>

    <style>
        .chat-container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }
        .chat-messages {
            height: 500px;
            overflow-y: auto;
            padding: 15px;
            background-color: #f9f9f9;
        }
        .message {
            margin-bottom: 15px;
            padding: 10px 15px;
            border-radius: 18px;
            max-width: 70%;
        }
        .user-message {
            background-color: #e3f2fd;
            margin-left: auto;
            border-bottom-right-radius: 0;
        }
        .assistant-message {
            background-color: #f1f1f1;
            margin-right: auto;
            border-bottom-left-radius: 0;
        }
        .chat-input {
            display: flex;
            padding: 15px;
            background-color: #fff;
            border-top: 1px solid #ddd;
        }
        #question-input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 20px;
            margin-left: 10px;
        }
        #send-btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }
        .loading {
            display: none;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body class="bg-gray-100">
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-center mb-8">المساعد القانوني السعودي</h1>

    <div class="chat-container bg-white shadow-lg">
        <div class="chat-messages" id="chat-messages">
            <!-- سيتم عرض الرسائل هنا -->
        </div>

        <div class="loading" id="loading">
            <p>جاري تحضير الإجابة...</p>
        </div>

        <div class="chat-input">
            <input type="text" id="question-input" placeholder="اطرح سؤالك القانوني هنا..." autofocus>
            <button id="send-btn">إرسال</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatMessages = document.getElementById('chat-messages');
        const questionInput = document.getElementById('question-input');
        const sendBtn = document.getElementById('send-btn');
        const loadingIndicator = document.getElementById('loading');

        // تحميل سجل المحادثة عند بدء الصفحة
        loadChatHistory();

        // إرسال السؤال عند الضغط على Enter
        questionInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendQuestion();
            }
        });

        // إرسال السؤال عند النقر على الزر
        sendBtn.addEventListener('click', sendQuestion);

        function sendQuestion() {
            const question = questionInput.value.trim();
            if (!question) return;

            // إضافة سؤال المستخدم إلى الشات
            addMessage('user', question);
            questionInput.value = '';

            // عرض مؤشر التحميل
            loadingIndicator.style.display = 'block';

            // إرسال السؤال إلى الخادم
            fetch('{{ route("ask") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    question: question,
                    stream: false // يمكنك تغيير هذا إلى true لتفعيل الـ Streaming
                })
            })
                .then(response => response.json())
                .then(data => {
                    // إخفاء مؤشر التحميل
                    loadingIndicator.style.display = 'none';

                    // إضافة إجابة المساعد
                    if (data.answer) {
                        addMessage('assistant', data.answer);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    loadingIndicator.style.display = 'none';
                    addMessage('assistant', 'حدث خطأ أثناء معالجة سؤالك. يرجى المحاولة مرة أخرى.');
                });
        }

        function addMessage(sender, text) {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('message');
            messageDiv.classList.add(sender === 'user' ? 'user-message' : 'assistant-message');
            messageDiv.textContent = text;

            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function loadChatHistory() {
            fetch('{{ route("chat_h") }}', {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.history && data.history.length > 0) {
                        data.history.forEach(msg => {
                            addMessage(msg.role === 'user' ? 'user' : 'assistant', msg.content);
                        });
                    }
                });
        }
    });
</script>
</body>
</html>
