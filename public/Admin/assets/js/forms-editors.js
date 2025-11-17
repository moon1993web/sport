/**
 * Form Editors
 */

'use strict';

(function () {
  // Snow Theme
  // --------------------------------------------------------------------
  const snowEditor = new Quill('#snow-editor', {
    bounds: '#snow-editor',
    modules: {
      formula: true,
      toolbar: '#snow-toolbar'
    },
    theme: 'snow'
  });

  // Bubble Theme
  // --------------------------------------------------------------------
  const bubbleEditor = new Quill('#bubble-editor', {
    modules: {
      toolbar: '#bubble-toolbar'
    },
    theme: 'bubble'
  });

  // Full Toolbar
  // --------------------------------------------------------------------
  const fullToolbar = [
    [
      {
        font: []
      },
      {
        size: []
      }
    ],
    ['bold', 'italic', 'underline', 'strike'],
    [
      {
        color: []
      },
      {
        background: []
      }
    ],
    [
      {
        script: 'super'
      },
      {
        script: 'sub'
      }
    ],
    [
      {
        header: '1'
      },
      {
        header: '2'
      },
      'blockquote',
      'code-block'
    ],
    [
      {
        list: 'ordered'
      },
      {
        list: 'bullet'
      },
      {
        indent: '-1'
      },
      {
        indent: '+1'
      }
    ],
    [{ direction: 'rtl' }],
    ['link', 'image', 'video', 'formula'],
    ['clean']
  ];
  const fullEditor = new Quill('#full-editor', {
    bounds: '#full-editor',
    placeholder: 'اینجا بنویسید...',
    modules: {
      formula: true,
      toolbar: fullToolbar
    },
    theme: 'snow'
  });



 // پیدا کردن فرمی که ویرایشگر در آن قرار دارد
  // نکته: مطمئن شوید تگ <form> شما یک id مشخص دارد، مثلا <form id="create-blog-form" ...>
  // اگر فرم شما id ندارد، می‌توانید با استفاده از کلاس یا روش دیگر آن را انتخاب کنید.
  const form = document.querySelector('#full-editor').closest('form');
  
  if (form) {
    form.addEventListener('submit', function (e) {
      // گرفتن مقدار فیلد مخفی
      const contentInput = document.getElementById('content');
      
      // کپی کردن محتوای HTML از ویرایشگر به داخل فیلد مخفی
      // ما از fullEditor.root.innerHTML برای گرفتن محتوای کامل HTML استفاده می‌کنیم.
      contentInput.value = fullEditor.root.innerHTML;
    });
  }




// این کد هم استایل placeholder و هم جهت‌گیری متن اصلی ویرایشگر را تغییر می‌دهد

  const style = document.createElement('style');

  style.innerHTML = `
    /* -- START: NEW RULE -- */
    /* این قانون جدید، متن اصلی ویرایشگر و مکان‌نما را راست‌چین می‌کند */
    #full-editor .ql-editor {
      direction: rtl;
      text-align: right;
    }
    /* -- END: NEW RULE -- */

    /* این قانون برای استایل placeholder است */
    #full-editor .ql-editor.ql-blank::before {
      text-align: right;
      font-size: 1.1rem;
      right: 15px;
      left: auto;
    }
  `;

  document.head.appendChild(style);








})();
