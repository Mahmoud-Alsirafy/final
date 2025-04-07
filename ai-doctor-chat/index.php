<?php
session_start();
if(!isset($_SESSION['login'])){
    header("location:../register.php");
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طبيب الذكاء الاصطناعي</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Tajawal', sans-serif;
        }
        
        body {
            background-color: #1F1F1F;
            color: white;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .app-bar {
            background-color: #1F1F1F;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #444;
        }

        .app-title {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
        }

        .app-title h1 {
            font-size: 25px;
            margin-right: 10px;
        }

        span{
            color: #00ffbf;
        }

        .logo {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain; /* لضمان ظهور الصورة بشكل متناسق */
        }


        .divider {
            height: 2px;
            background-color: #444;
            margin: 5px 0;
        }

        .chat-container {
            flex: 1;
            overflow-y: auto;
            padding: 10px;
            scrollbar-width: thin;
            scrollbar-color: #00ffbf #2D2D2D;
        }

        /* تخصيص شريط التمرير لمتصفحات WebKit */
        .chat-container::-webkit-scrollbar {
            width: 8px;
        }

        .chat-container::-webkit-scrollbar-track {
            background: #2D2D2D;
            border-radius: 4px;
        }

        .chat-container::-webkit-scrollbar-thumb {
            background: #00ffbf;
            border-radius: 4px;
        }

        .chat-container::-webkit-scrollbar-thumb:hover {
            background: #00e6ff;
        }

        /* تخصيص شريط التمرير داخل حقل الكتابة ليشابه شريط التمرير العام */
        #message-input::-webkit-scrollbar {
            width: 8px; /* عرض الشريط */
        }

        #message-input::-webkit-scrollbar-track {
            background: #2D2D2D; /* لون الخلفية */
            border-radius: 4px;
        }

        #message-input::-webkit-scrollbar-thumb {
            background: #00ffbf; /* لون شريط التمرير */
            border-radius: 4px;
        }

        #message-input::-webkit-scrollbar-thumb:hover {
            background: #00e6ff; /* لون عند التحويم */
        }

        /* دعم متصفحات أخرى */
        #message-input {
            scrollbar-width: thin;
            scrollbar-color: #00ffbf #2D2D2D;
        }

        .message {
            max-width: 80%;
            margin: 10px;
            padding: 12px 16px;
            border-radius: 20px;
            position: relative;
            word-wrap: break-word;
            display: inline-block;
            min-width: 60px;
            animation: messageAppear 0.3s ease-out;
        }

        @keyframes messageAppear {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .user-message {
            background-color: #00ffbf;
            color: black;
            margin-left: auto;
            border-bottom-right-radius: 5px;
            text-align: left;
        }

        .bot-message {
            background-color: #3B3B3B;
            margin-right: auto;
            border-bottom-left-radius: 5px;
            text-align: right;
        }

        .copy-icon {
            position: absolute;
            left: 8px;
            bottom: 8px;
            font-size: 14px;
            cursor: pointer;
            opacity: 0.5;
            transition: opacity 0.2s;
        }

        .user-message .copy-icon {
            left: auto;
            right: 8px;
            color: #333;
        }

        .copy-icon:hover {
            opacity: 1;
        }

        .message-time {
            font-size: 11px;
            color: #aaa;
            margin-top: 4px; /* إضافة هامش علوي */
            text-align: center; /* توسيط الوقت */
            width: 100%; /* جعل العرض يغطي كامل العرض */
        }

        .user-message + .message-time {
            text-align: right;
        }

        .bot-message + .message-time {
            text-align: left;
        }

        .input-container {
            padding: 10px;
            display: flex;
            align-items: center;
            background-color: #1F1F1F;
        }

        #message-input {
            flex: 1;
            background-color: #333;
            border: 1px solid #00ffbf;
            border-radius: 15px;
            padding: 15px 20px;
            color: white;
            max-height: 150px;
            overflow-y: auto;
            resize: none;
            outline: none;
            font-family: 'Tajawal', sans-serif;
            direction: rtl;
        }

        #message-input:focus {
            border-width: 2px;
        }

        #send-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #00ffbf, #00e6ff);
            border: none;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.3);
        }

        #send-btn:hover {
            opacity: 0.9;
        }

        .send-icon {
            color: white;
            font-size: 20px;
        }

        .more-menu {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #2D2D2D;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            padding: 15px;
            display: none;
            z-index: 100;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 15px;
            color: white;
            cursor: pointer;
        }

        .menu-item:hover {
            background-color: #444;
        }

        .menu-icon {
            margin-left: 15px;
        }

        .menu-divider {
            height: 1px;
            background-color: #444;
            margin: 5px 0;
        }

        .snackbar {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            display: none;
            z-index: 100;
            animation: fadeInOut 3s ease-in-out;
        }

        @keyframes fadeInOut {
            0% { opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { opacity: 0; }
        }

        .typing-indicator {
            display: inline-block;
            padding: 10px 15px;
            background-color: #3B3B3B;
            border-radius: 20px;
            margin: 10px;
        }

        .typing-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #aaa;
            border-radius: 50%;
            margin: 0 2px;
            animation: typingAnimation 1.4s infinite ease-in-out;
        }

        .typing-dot:nth-child(1) {
            animation-delay: 0s;
        }

        .typing-dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typingAnimation {
            0%, 60%, 100% { transform: translateY(0); }
            30% { transform: translateY(-5px); }
        }

        @media (max-width: 600px) {
            .message {
                max-width: 90%;
                padding: 10px 14px;
            }
            
            .copy-icon {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="app-bar">
        <div class="logo">
            <img src="imgs/logo.png" alt="Logo">
        </div>
        <div class="app-title">
            <h1>Hi, iam your <span>AI Doctor</span></h1>
        </div>
        <i class="fas fa-ellipsis-v" id="menu-btn" style="cursor: pointer;"></i>
    </div>
    <div class="divider"></div>
    <div class="chat-container" id="chat-container">
        <!-- الرسائل تظهر هنا -->
    </div>
    <div class="divider"></div>
    <div class="input-container">
        <textarea id="message-input" placeholder="اكتب رسالتك هنا..." rows="1"></textarea>
        <button id="send-btn">
            <i class="fas fa-paper-plane send-icon"></i>
        </button>
    </div>

    <!-- قائمة أكثر -->
    <div class="more-menu" id="more-menu">
        <div class="menu-item" id="new-chat-btn">
            <i class="fas fa-plus menu-icon"></i>
            <span>New Chat</span>
        </div>
        <div class="menu-divider"></div>
        <div class="menu-item" id="close-menu-btn">
            <i class="fas fa-times menu-icon"></i>
            <span>Cancel</span>
        </div>
    </div>

    <!-- إشعار النسخ -->
    <div class="snackbar" id="snackbar"></div>

    <script>
        // استبدل هذا بمفتاح API الخاص بك
        const API_KEY = "AIzaSyAmgy-KtMbpmLUPpZYc8C--DzpVKZAp7Lo";
        
        // عناصر DOM
        const chatContainer = document.getElementById('chat-container');
        const messageInput = document.getElementById('message-input');
        const sendBtn = document.getElementById('send-btn');
        const menuBtn = document.getElementById('menu-btn');
        const moreMenu = document.getElementById('more-menu');
        const newChatBtn = document.getElementById('new-chat-btn');
        const closeMenuBtn = document.getElementById('close-menu-btn');
        const snackbar = document.getElementById('snackbar');

        // مصفوفة الرسائل
        let messages = [];

        // تكبير مربع النص تلقائياً
        messageInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        // إرسال رسالة
        async function sendMessage() {
            const message = messageInput.value.trim();
            if (message === '') return;

            // إضافة رسالة المستخدم
            addMessage(true, message);
            messageInput.value = '';
            messageInput.style.height = 'auto';

            // التحقق من الترحيب أو الشكر
            if (isThankYou(message)) {
                const response = generateThankYouResponse(message);
                setTimeout(() => addMessage(false, response), 500);
                return;
            }

            if (isGreeting(message)) {
                const response = generateGreetingResponse(message);
                setTimeout(() => addMessage(false, response), 500);
                return;
            }

            // إذا كانت الرسالة غير طبية
            if (!isMedicalRelated(message)) {
                const isArabic = /[ء-ي]/.test(message);
                const isFrench = /bonjour|salut|merci/i.test(message);
                
                const response = isArabic 
                    ? "أنا متخصص في الرد على الاستفسارات الطبية فقط. يرجى طرح سؤال طبي."
                    : isFrench
                        ? "Je ne réponds qu'aux questions médicales. Posez une question sur la santé."
                        : "I only respond to medical inquiries. Please ask a health-related question.";
                
                setTimeout(() => addMessage(false, response), 500);
                return;
            }

            // إظهار مؤشر الكتابة
            showTypingIndicator();

            try {
                // الاتصال بـ Gemini API
                const response = await callGeminiAPI(message);
                
                // إخفاء مؤشر الكتابة
                hideTypingIndicator();
                
                // إضافة رد الذكاء الاصطناعي
                addMessage(false, response);
            } catch (error) {
                hideTypingIndicator();
                addMessage(false, "حدث خطأ في الاتصال بالخادم: " + error.message);
            }
        }

        // الاتصال بـ Gemini API
        async function callGeminiAPI(message) {
            const API_URL = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${API_KEY}`;
            
            const requestBody = {
                contents: [{
                    parts: [{
                        text: message
                    }]
                }]
            };

            const response = await fetch(API_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(requestBody)
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.error.message || "Failed to fetch response");
            }

            return data.candidates[0].content.parts[0].text;
        }

        // إضافة رسالة إلى الدردشة
        function addMessage(isUser, message) {
            const messageObj = {
                isUser,
                message,
                date: new Date()
            };
            messages.push(messageObj);
            renderMessages();
        }

        // عرض الرسائل
        function renderMessages() {
            chatContainer.innerHTML = '';
            messages.forEach(msg => {
                const messageContainer = document.createElement('div');
                messageContainer.style.display = 'flex';
                messageContainer.style.flexDirection = 'column';
                messageContainer.style.alignItems = msg.isUser ? 'flex-end' : 'flex-start';
                messageContainer.style.margin = '8px 0';
                
                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${msg.isUser ? 'user-message' : 'bot-message'}`;
                
                // جعل النص يتكيف مع حجم المحتوى
                const messageText = document.createElement('div');
                messageText.style.display = 'inline-block';
                messageText.style.padding = msg.isUser ? '0 20px 0 0' : '0 20px 0 0';
                messageText.textContent = msg.message;
                
                // إضافة أيقونة النسخ
                const copyIcon = document.createElement('i');
                copyIcon.className = 'fas fa-copy copy-icon';
                copyIcon.title = 'نسخ الرسالة';
                
                // تكبير أيقونة النسخ للرسائل الطويلة
                if (msg.message.length > 100) {
                    copyIcon.style.fontSize = '16px';
                    copyIcon.style.padding = '4px';
                }
                
                copyIcon.addEventListener('click', () => {
                    copyToClipboard(msg.message);
                    showSnackbar('تم نسخ الرسالة');
                });
                
                messageDiv.appendChild(messageText);
                messageDiv.appendChild(copyIcon);
                
                // إضافة وقت الرسالة
                const timeDiv = document.createElement('div');
                timeDiv.className = 'message-time';
                timeDiv.textContent = formatTime(msg.date);
                
                messageContainer.appendChild(messageDiv);
                messageContainer.appendChild(timeDiv);
                chatContainer.appendChild(messageContainer);
            });
            
            // التمرير إلى الأسفل
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        // تنسيق الوقت
        function formatTime(date) {
            const hours = date.getHours().toString().padStart(2, '0');
            const minutes = date.getMinutes().toString().padStart(2, '0');
            return `${hours}:${minutes}`;
        }

        // التحقق من الترحيب
        function isGreeting(message) {
            const lowerMessage = message.toLowerCase();
            const arabicGreetings = ['مرحبا', 'اهلا', 'سلام', 'صباح الخير', 'مساء الخير', 'اهلين'];
            const englishGreetings = ['hello', 'hi', 'hey', 'good morning', 'good evening'];
            const frenchGreetings = ['bonjour', 'salut', 'bonsoir'];

            return arabicGreetings.some(word => lowerMessage.includes(word)) ||
                englishGreetings.some(word => lowerMessage.includes(word)) ||
                frenchGreetings.some(word => lowerMessage.includes(word));
        }

        // إنشاء رد ترحيب
        function generateGreetingResponse(message) {
            const lowerMessage = message.toLowerCase();
            const isArabic = ['مرحبا', 'اهلا', 'سلام'].some(word => lowerMessage.includes(word));
            const isFrench = ['bonjour', 'salut', 'bonsoir'].some(word => lowerMessage.includes(word));

            if (isArabic) {
                return 'مرحباً بك! أنا هنا لمساعدتك في الاستفسارات الطبية. كيف يمكنني مساعدتك اليوم؟';
            } else if (isFrench) {
                return 'Bonjour! Je suis là pour répondre à vos questions médicales. Comment puis-je vous aider?';
            } else {
                return 'Hello! I\'m here to help with medical inquiries. How can I assist you today?';
            }
        }

        // التحقق من الشكر
        function isThankYou(message) {
            const lowerMessage = message.toLowerCase();
            const arabicThanks = ['شكرا', 'متشكر', 'ممنون', 'يعطيك العافية'];
            const englishThanks = ['thank you', 'thanks', 'appreciate'];
            const frenchThanks = ['merci', 'je vous remercie'];
            
            return arabicThanks.some(word => lowerMessage.includes(word)) ||
                englishThanks.some(word => lowerMessage.includes(word)) ||
                frenchThanks.some(word => lowerMessage.includes(word));
        }

        // إنشاء رد الشكر
        function generateThankYouResponse(message) {
            const lowerMessage = message.toLowerCase();
            const isArabic = ['شكرا', 'متشكر', 'ممنون'].some(word => lowerMessage.includes(word));
            const isFrench = ['merci', 'remercie'].some(word => lowerMessage.includes(word));

            if (isArabic) {
                return 'العفو! لا تتردد في سؤالي أي استفسار طبي آخر.';
            } else if (isFrench) {
                return 'Je vous en prie! N\'hésitez pas à me poser d\'autres questions médicales.';
            } else {
                return 'You\'re welcome! Feel free to ask any other medical questions.';
            }
        }

        // التحقق من أن الرسالة طبية
        function isMedicalRelated(message) {
            const lowerMessage = message.toLowerCase();
            const arabicMedical = ['طبيب', 'دواء', 'علاج', 'مرض', 'ألم', 'صحة', 'جراحة', 'حمل', 'ولادة'];
            const englishMedical = ['doctor', 'medicine', 'treatment', 'disease', 'pain', 'health', 'surgery', 'pregnancy'];
            const frenchMedical = ['médecin', 'médicament', 'traitement', 'maladie', 'douleur', 'santé', 'chirurgie'];

            return arabicMedical.some(word => lowerMessage.includes(word)) ||
                englishMedical.some(word => lowerMessage.includes(word)) ||
                frenchMedical.some(word => lowerMessage.includes(word));
        }

        // نسخ إلى الحافظة
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text);
        }

        // عرض إشعار
        function showSnackbar(message) {
            snackbar.textContent = message;
            snackbar.style.display = 'block';
            setTimeout(() => {
                snackbar.style.display = 'none';
            }, 3000);
        }

        // عرض مؤشر الكتابة
        function showTypingIndicator() {
            const typingDiv = document.createElement('div');
            typingDiv.className = 'typing-indicator';
            typingDiv.id = 'typing-indicator';
            typingDiv.innerHTML = `
                <span class="typing-dot"></span>
                <span class="typing-dot"></span>
                <span class="typing-dot"></span>
            `;
            chatContainer.appendChild(typingDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        // إخفاء مؤشر الكتابة
        function hideTypingIndicator() {
            const typingIndicator = document.getElementById('typing-indicator');
            if (typingIndicator) {
                typingIndicator.remove();
            }
        }

        // محادثة جديدة
        function newChat() {
            messages = [];
            renderMessages();
        }

        // مستمعي الأحداث
        sendBtn.addEventListener('click', sendMessage);
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        menuBtn.addEventListener('click', () => {
            moreMenu.style.display = 'block';
        });

        closeMenuBtn.addEventListener('click', () => {
            moreMenu.style.display = 'none';
        });

        newChatBtn.addEventListener('click', () => {
            moreMenu.style.display = 'none';
            newChat();
        });

        // إغلاق القائمة عند النقر خارجها
        document.addEventListener('click', (e) => {
            if (!moreMenu.contains(e.target) && e.target !== menuBtn) {
                moreMenu.style.display = 'none';
            }
        });

        // رسالة ترحيبية أولية
        setTimeout(() => {
            addMessage(false, "مرحباً بك! أنا هنا لمساعدتك في الاستفسارات الطبية. كيف يمكنني مساعدتك اليوم؟");
        }, 500);
    </script>
</body>
</html>