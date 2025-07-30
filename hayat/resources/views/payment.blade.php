@extends('welcome')
@section('content')
@section('title', 'پرداخت نا موفق')
<style>
    #copyHint {
    display: none; /* Initially hidden */
    transition: opacity 0.3s ease-in-out; /* Smooth transition */
}



</style>


<div class="pb-6 sm:pb-8 lg:pb-12 pt-24 min-h-screen container mx-auto print:pt-7 print:pb-6" dir="rtl">
    <div class="bg-red-600 rounded-lg shadow-lg print:shadow-none p-0 md:p-8 print:p-0" dir="rtl">

        <div class="w-full h-full px-4 py-8 print:py-0">
            <div class="bg-gray-100 rounded-lg shadow-lg print:shadow-none p-4">

                <!-- Receipt header -->
                <header class="flex flex-col justify-center items-center mb-4 flex-wrap">
                    <div class="w-full h-full md:w-auto md:h-auto md:text-right text-center">
                        <div class="flex justify-center">
                            <img class="h-40" src="/images/logo-min.png" alt="Logo">
                        </div>

                        <div class="my-5 grid gap-4">
                            <div class="contentToShare">
                                <div class="fixed opacity-0">
                                    <span>کافه حیات خلوت</span>
                                </div>
                                <!-- Payment Status -->
                                <div class="flex text-2xl font-bold items-center gap-3 justify-center">
                                    <i class="fa-regular fa-rectangle-xmark text-red-600 -mb-1"></i>
                                    <h1 class="mb-4">پرداخت ناموفق</h1>
                                </div>
    
                                <!-- Payment Tracking -->
                                <div class="flex items-center gap-2 py-1 px-3 rounded-lg bg-gray-300 justify-center" onclick="copyToClipboard(document.getElementById('paymentTrackId').innerText)">
                                    <p class="">
                                        شماره پیگیری : <span class="text-primary" id="paymentTrackId">257489541</span>
                                    </p>
                                  
                                    <button class="btn btn-circle bg-gray-200 hover:bg-gray-400 print:hidden" onclick="copyToClipboard(document.getElementById('paymenttrackid').innerText)">
                                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19.53 8L14 2.47C13.8595 2.32931 13.6688 2.25018 13.47 2.25H11C10.2707 2.25 9.57118 2.53973 9.05546 3.05546C8.53973 3.57118 8.25 4.27065 8.25 5V6.25H7C6.27065 6.25 5.57118 6.53973 5.05546 7.05546C4.53973 7.57118 4.25 8.27065 4.25 9V19C4.25 19.7293 4.53973 20.4288 5.05546 20.9445C5.57118 21.4603 6.27065 21.75 7 21.75H14C14.7293 21.75 15.4288 21.4603 15.9445 20.9445C16.4603 20.4288 16.75 19.7293 16.75 19V17.75H17C17.7293 17.75 18.4288 17.4603 18.9445 16.9445C19.4603 16.4288 19.75 15.7293 19.75 15V8.5C19.7421 8.3116 19.6636 8.13309 19.53 8ZM14.25 4.81L17.19 7.75H14.25V4.81ZM15.25 19C15.25 19.3315 15.1183 19.6495 14.8839 19.8839C14.6495 20.1183 14.3315 20.25 14 20.25H7C6.66848 20.25 6.35054 20.1183 6.11612 19.8839C5.8817 19.6495 5.75 19.3315 5.75 19V9C5.75 8.66848 5.8817 8.35054 6.11612 8.11612C6.35054 7.8817 6.66848 7.75 7 7.75H8.25V15C8.25 15.7293 8.53973 16.4288 9.05546 16.9445C9.57118 17.4603 10.2707 17.75 11 17.75H15.25V19ZM17 16.25H11C10.6685 16.25 10.3505 16.1183 10.1161 15.8839C9.8817 15.6495 9.75 15.3315 9.75 15V5C9.75 4.66848 9.8817 4.35054 10.1161 4.11612C10.3505 3.8817 10.6685 3.75 11 3.75H12.75V8.5C12.7526 8.69811 12.8324 8.88737 12.9725 9.02747C13.1126 9.16756 13.3019 9.24741 13.5 9.25H18.25V15C18.25 15.3315 18.1183 15.6495 17.8839 15.8839C17.6495 16.1183 17.3315 16.25 17 16.25Z" fill="#000000"/>
                                            </svg>
                                    </button>
                                </div>
                            </div>
                            <div id="copyHint" class="hidden text-green-600 font-bold p-2 bg-green-100 rounded-md mt-2 text-center print:hidden">
                                کپی شد
                            </div>
                        </div>
                    </div>

                    <style>
                        #orderQRcanvas > canvas {
                            border-radius: 1rem;
                        }
                    </style>

                    <div class="flex flex-col items-center justify-center print:hidden">
                        <div class="flex flex-wrap mt-3 justify-center items-center gap-3 print:hidden">

      
                        

                            <!-- PDF Download Button -->
                            <button class="btn btn-circle" onclick="downloadAsPdf()">
                                <svg class="w-7 h-7" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                    viewBox="0 0 309.267 309.267" xml:space="preserve">
                                <g>
                                    <path style="fill:#E2574C;" d="M38.658,0h164.23l87.049,86.711v203.227c0,10.679-8.659,19.329-19.329,19.329H38.658
                                        c-10.67,0-19.329-8.65-19.329-19.329V19.329C19.329,8.65,27.989,0,38.658,0z"/>
                                    <path style="fill:#B53629;" d="M289.658,86.981h-67.372c-10.67,0-19.329-8.659-19.329-19.329V0.193L289.658,86.981z"/>
                                    <path style="fill:#FFFFFF;" d="M217.434,146.544c3.238,0,4.823-2.822,4.823-5.557c0-2.832-1.653-5.567-4.823-5.567h-18.44
                                        c-3.605,0-5.615,2.986-5.615,6.282v45.317c0,4.04,2.3,6.282,5.412,6.282c3.093,0,5.403-2.242,5.403-6.282v-12.438h11.153
                                        c3.46,0,5.19-2.832,5.19-5.644c0-2.754-1.73-5.49-5.19-5.49h-11.153v-16.903C204.194,146.544,217.434,146.544,217.434,146.544z
                                        M155.107,135.42h-13.492c-3.663,0-6.263,2.513-6.263,6.243v45.395c0,4.629,3.74,6.079,6.417,6.079h14.159
                                        c16.758,0,27.824-11.027,27.824-28.047C183.743,147.095,173.325,135.42,155.107,135.42z M155.755,181.946h-8.225v-35.334h7.413
                                        c11.221,0,16.101,7.529,16.101,17.918C171.044,174.253,166.25,181.946,155.755,181.946z M106.33,135.42H92.964
                                        c-3.779,0-5.886,2.493-5.886,6.282v45.317c0,4.04,2.416,6.282,5.663,6.282s5.663-2.242,5.663-6.282v-13.231h8.379
                                        c10.341,0,18.875-7.326,18.875-19.107C125.659,143.152,117.425,135.42,106.33,135.42z M106.108,163.158h-7.703v-17.097h7.703
                                        c4.755,0,7.78,3.711,7.78,8.553C113.878,159.447,110.863,163.158,106.108,163.158z"/>
                                </g>
                                </svg>
                            </button>

                            <!-- Share Button -->
                            <button class="btn btn-circle shareBtn whatsappBtn">
                                <svg class="w-7 h-7" viewBox="0 0 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Color-" transform="translate(-700.000000, -360.000000)" fill="#67C15E">
                                            <path d="M723.993033,360 C710.762252,360 700,370.765287 700,383.999801 C700,389.248451 701.692661,394.116025 704.570026,398.066947 L701.579605,406.983798 L710.804449,404.035539 C714.598605,406.546975 719.126434,408 724.006967,408 C737.237748,408 748,397.234315 748,384.000199 C748,370.765685 737.237748,360.000398 724.006967,360.000398 L723.993033,360.000398 L723.993033,360 Z M717.29285,372.190836 C716.827488,371.07628 716.474784,371.034071 715.769774,371.005401 C715.529728,370.991464 715.262214,370.977527 714.96564,370.977527 C714.04845,370.977527 713.089462,371.245514 712.511043,371.838033 C711.806033,372.557577 710.056843,374.23638 710.056843,377.679202 C710.056843,381.122023 712.567571,384.451756 712.905944,384.917648 C713.258648,385.382743 717.800808,392.55031 724.853297,395.471492 C730.368379,397.757149 732.00491,397.545307 733.260074,397.27732 C735.093658,396.882308 737.393002,395.527239 737.971421,393.891043 C738.54984,392.25405 738.54984,390.857171 738.380255,390.560912 C738.211068,390.264652 737.745308,390.095816 737.040298,389.742615 C736.335288,389.389811 732.90737,387.696673 732.25849,387.470894 C731.623543,387.231179 731.017259,387.315995 730.537963,387.99333 C729.860819,388.938653 729.198006,389.89831 728.661785,390.476494 C728.238619,390.928051 727.547144,390.984595 726.969123,390.744481 C726.193254,390.420348 724.021298,389.657798 721.340985,387.273388 C719.267356,385.42535 717.856938,383.125756 717.448104,382.434484 C717.038871,381.729275 717.405907,381.319529 717.729948,380.938852 C718.082653,380.501232 718.421026,380.191036 718.77373,379.781688 C719.126434,379.372738 719.323884,379.160897 719.549599,378.681068 C719.789645,378.215575 719.62006,377.735746 719.450874,377.382942 C719.281687,377.030139 717.871269,373.587317 717.29285,372.190836 Z" id="Whatsapp">
                                
                                </path>
                                        </g>
                                    </g>
                                </svg>
                            </button>
                            <button class="btn btn-circle shareBtn telegramBtn">
                                <svg class="w-7 h-7" viewBox="0 0 256 256" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid">
                                    <g>
                                            <path d="M128,0 C57.307,0 0,57.307 0,128 L0,128 C0,198.693 57.307,256 128,256 L128,256 C198.693,256 256,198.693 256,128 L256,128 C256,57.307 198.693,0 128,0 L128,0 Z" fill="#40B3E0">
                            
                            </path>
                                            <path d="M190.2826,73.6308 L167.4206,188.8978 C167.4206,188.8978 164.2236,196.8918 155.4306,193.0548 L102.6726,152.6068 L83.4886,143.3348 L51.1946,132.4628 C51.1946,132.4628 46.2386,130.7048 45.7586,126.8678 C45.2796,123.0308 51.3546,120.9528 51.3546,120.9528 L179.7306,70.5928 C179.7306,70.5928 190.2826,65.9568 190.2826,73.6308" fill="#FFFFFF">
                            
                            </path>
                                            <path d="M98.6178,187.6035 C98.6178,187.6035 97.0778,187.4595 95.1588,181.3835 C93.2408,175.3085 83.4888,143.3345 83.4888,143.3345 L161.0258,94.0945 C161.0258,94.0945 165.5028,91.3765 165.3428,94.0945 C165.3428,94.0945 166.1418,94.5735 163.7438,96.8115 C161.3458,99.0505 102.8328,151.6475 102.8328,151.6475" fill="#D2E5F1">
                            
                            </path>
                                            <path d="M122.9015,168.1154 L102.0335,187.1414 C102.0335,187.1414 100.4025,188.3794 98.6175,187.6034 L102.6135,152.2624" fill="#B5CFE4">
                            
                            </path>
                                    </g>
                            </svg>
                            </button>
                            <button class="btn btn-circle shareBtn copyBtn">
                                <svg fill="#000000" class="w-7 h-7" viewBox="0 0 24 24" id="copy" data-name="Flat Line" xmlns="http://www.w3.org/2000/svg" class="icon flat-line"><polygon id="secondary" points="19 6 19 17 9 17 9 3 16 3 19 6" style="fill: rgb(44, 169, 188); stroke-width: 2;"></polygon><path id="primary" d="M5,6V20a1,1,0,0,0,1,1H16" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path><polygon id="primary-2" data-name="primary" points="19 6 19 17 9 17 9 3 16 3 19 6" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></polygon></svg>
                            </button>

                        </div>
                    </div>
                </header>

                <!-- Payment Details -->
                <section class="contentToShare mb-8 md:text-right text-center mt-10 print:mt-5">
                    <h2 class="text-2xl font-bold mb-9 text-center">اطلاعات پرداخت</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-10 justify-between justify-items-center mb-2 w-full">
                        <div>
                            <p class="text-black font-bold text-2xl">نحوه پرداخت:</p>
                            <p class="text-xl">درگاه پرداخت زرینپال</p>
                        </div>
                        <div>
                            <p class="text-black font-bold text-2xl">شماره کارت:</p>
                            <p class="text-xl">4719 **** ****</p>
                        </div>
                        <div>
                            <p class="text-black font-bold text-2xl">نام سفارش دهنده:</p>
                            <p class="text-xl">امید رونق زاده</p>
                        </div>
                        <div>
                            <p class="text-black font-bold text-2xl">زمان پرداخت:</p>
                            <p class="text-xl">12:30 1402/8/9</p>
                        </div>
                        <div>
                            <p class="text-black font-bold text-2xl">شماره پرداخت ناموفق:</p>
                            <p class="break-words text-xl">59478541787574</p>
                        </div>
                        <div>
                            <p class="text-black font-bold text-2xl">شماره پشتیبانی:</p>
                            <a href="tel:09373729154" class=" text-blue-600 hover:underline font-normal text-xl">
                                09373729154
                            </a>
                        </div>
                    </div>
                </section>

                <!-- Action Buttons -->
                <div class="grid grid-cols-2  justify-center gap-5 max-w-2xl mx-auto print:hidden">
                    <a href="/" class="btn btn-primary max-w-sm">بازگشت به سایت</a>
                    <a href="/dash" class="btn btn-primary max-w-sm">بازگشت به داشبورد</a>
                </div>
            </div>
        </div>
    </div>
    <div class="hidden print:block">
        @include('footer')
    </div>
</div>
<div class="print:hidden">
    @include('footer')
</div>



<script>
  
    function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(
        () => {
            // Show the success message
            const hint = document.getElementById("copyHint");
            hint.style.display = "block";  // Show the hint
            setTimeout(() => {
                hint.style.display = "none";  // Hide the hint after 2 seconds
            }, 2000);
        },
        (err) => console.log("Failed to copy: " + err) // Log error in console if failed
    );
}

function downloadAsPdf() {
    window.print();
}



</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        class ContentSharer {
            constructor(contentClass) {
                // Select all elements with the specified class
                this.contentElements = document.querySelectorAll(contentClass);
            }

            // Get the content text from all content sections combined
            getCombinedContent() {
                let combinedContent = '';
                this.contentElements.forEach((element) => {
                    combinedContent += element.innerText + "\n\n";  // Append each section's text
                });
                return combinedContent.trim();  // Remove the last extra newline
            }

            // Share content on WhatsApp
            shareOnWhatsApp() {
                const content = this.getCombinedContent();
                if (content) {
                    const url = encodeURIComponent(content);  // URL encode the content
                    const whatsappUrl = `https://wa.me/?text=${url}`; // WhatsApp sharing URL
                    window.open(whatsappUrl, '_blank');  // Open WhatsApp in a new tab
                }
            }

            // Share content on Telegram
            shareOnTelegram() {
                const content = this.getCombinedContent();
                if (content) {
                    const url = encodeURIComponent(content);  // URL encode the content
                    const telegramUrl = `https://t.me/share/url?url=${url}`; // Telegram sharing URL
                    window.open(telegramUrl, '_blank');  // Open Telegram in a new tab
                }
            }

            // Copy content to clipboard
            copyToClipboard() {
                const content = this.getCombinedContent();
                if (content) {
                    // Use the Clipboard API to copy content to the clipboard
                    navigator.clipboard.writeText(content).then(function() {
                       
                    }).catch(function(err) {
                        alert('Failed to copy: ' + err);
                    });
                }
            }
        }

        // Initialize the ContentSharer class for elements with the class 'contentToShare'
        const sharer = new ContentSharer('.contentToShare');  // Pass the content class selector

        // WhatsApp button click
        const whatsappButton = document.querySelector('.whatsappBtn');
        if (whatsappButton) {
            whatsappButton.addEventListener('click', function() {
                sharer.shareOnWhatsApp(); // Share all combined content on WhatsApp
            });
        }

        // Telegram button click
        const telegramButton = document.querySelector('.telegramBtn');
        if (telegramButton) {
            telegramButton.addEventListener('click', function() {
                sharer.shareOnTelegram(); // Share all combined content on Telegram
            });
        }

        // Copy button click
        const copyButton = document.querySelector('.copyBtn');
        if (copyButton) {
            copyButton.addEventListener('click', function() {
                sharer.copyToClipboard(); // Copy the combined content to clipboard
            });
        }
    });
</script>








@endsection
