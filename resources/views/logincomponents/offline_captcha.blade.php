<!-- Offline Algorithm Captcha -->
<div id="offline-captcha-wrapper" class="mb-4 hidden">
  <label class="block text-sm font-medium text-white/80 mb-2">
    <i class="fas fa-shield-alt mr-2"></i>Security Verification (Offline Mode)
  </label>
  
  <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20">
    <!-- Math Problem Display -->
    <div class="text-center mb-3">
      <div class="text-white text-lg font-semibold">
        Solve: <span id="math-question" class="text-[#F7B32B] text-xl"></span> = ?
      </div>
    </div>
    
    <!-- Answer Input -->
    <div class="flex gap-2">
      <input type="number" 
             id="math-answer" 
             name="math_answer"
             class="flex-1 px-3 py-2 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-[#F7B32B] focus:border-transparent"
             placeholder="Enter answer">
      
      <!-- Refresh Button -->
      <button type="button" 
              onclick="generateMathCaptcha()" 
              class="px-3 py-2 bg-white/20 hover:bg-white/30 border border-white/30 rounded-lg text-white transition-colors"
              title="Generate new problem">
        <i class="fas fa-sync-alt"></i>
      </button>
    </div>
    
    <!-- Hidden field for answer verification -->
    <input type="hidden" id="math-correct-answer" name="math_correct_answer">
    
    <!-- Error Message -->
    <div id="captcha-error" class="hidden mt-2 text-red-300 text-sm">
      <i class="fas fa-exclamation-triangle mr-1"></i>
      <span id="captcha-error-text">Incorrect answer. Please try again.</span>
    </div>
    
    <!-- Success Message -->
    <div id="captcha-success" class="hidden mt-2 text-green-300 text-sm">
      <i class="fas fa-check-circle mr-1"></i>
      <span>Correct! Proceeding with login...</span>
    </div>
  </div>
</div>

<script>
  let currentAnswer = 0;
  
  // Generate random math problem
  function generateMathCaptcha() {
    const operations = ['+', '-', '*'];
    const operation = operations[Math.floor(Math.random() * operations.length)];
    let num1, num2, answer;
    
    switch(operation) {
      case '+':
        num1 = Math.floor(Math.random() * 50) + 1; // 1-50
        num2 = Math.floor(Math.random() * 50) + 1; // 1-50
        answer = num1 + num2;
        break;
        
      case '-':
        num1 = Math.floor(Math.random() * 50) + 10; // 10-60
        num2 = Math.floor(Math.random() * num1) + 1; // 1-num1 (to avoid negative)
        answer = num1 - num2;
        break;
        
      case '*':
        num1 = Math.floor(Math.random() * 12) + 1; // 1-12
        num2 = Math.floor(Math.random() * 12) + 1; // 1-12
        answer = num1 * num2;
        break;
    }
    
    currentAnswer = answer;
    
    // Update display
    document.getElementById('math-question').textContent = `${num1} ${operation} ${num2}`;
    document.getElementById('math-correct-answer').value = answer;
    
    // Clear previous input and messages
    document.getElementById('math-answer').value = '';
    hideCaptchaMessages();
  }
  
  // Verify captcha answer
  function verifyMathCaptcha() {
    const userAnswer = parseInt(document.getElementById('math-answer').value);
    const correctAnswer = parseInt(document.getElementById('math-correct-answer').value);
    
    if (userAnswer === correctAnswer) {
      showCaptchaSuccess();
      return true;
    } else {
      showCaptchaError();
      generateMathCaptcha(); // Generate new problem on error
      return false;
    }
  }
  
  // Show error message
  function showCaptchaError() {
    const errorDiv = document.getElementById('captcha-error');
    const successDiv = document.getElementById('captcha-success');
    
    errorDiv.classList.remove('hidden');
    successDiv.classList.add('hidden');
    
    // Auto-hide after 3 seconds
    setTimeout(() => {
      errorDiv.classList.add('hidden');
    }, 3000);
  }
  
  // Show success message
  function showCaptchaSuccess() {
    const errorDiv = document.getElementById('captcha-error');
    const successDiv = document.getElementById('captcha-success');
    
    successDiv.classList.remove('hidden');
    errorDiv.classList.add('hidden');
    
    // Auto-hide after 2 seconds
    setTimeout(() => {
      successDiv.classList.add('hidden');
    }, 2000);
  }
  
  // Hide all messages
  function hideCaptchaMessages() {
    document.getElementById('captcha-error').classList.add('hidden');
    document.getElementById('captcha-success').classList.add('hidden');
  }
  
  // Initialize captcha when called
  function initOfflineCaptcha() {
    generateMathCaptcha();
    document.getElementById('offline-captcha-wrapper').classList.remove('hidden');
    
    // Add required attribute when in offline mode
    const mathAnswerInput = document.getElementById('math-answer');
    mathAnswerInput.setAttribute('required', 'required');
  }
  
  // Cleanup when switching back to online mode
  function cleanupOfflineCaptcha() {
    document.getElementById('offline-captcha-wrapper').classList.add('hidden');
    
    // Remove required attribute when not in offline mode
    const mathAnswerInput = document.getElementById('math-answer');
    mathAnswerInput.removeAttribute('required');
    mathAnswerInput.value = '';
  }
</script>
