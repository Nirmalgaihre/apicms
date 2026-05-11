@extends('layouts.admin')

@section('title', 'System User Guide')

@section('content')
<div class="max-w-4xl mx-auto py-6">
    <!-- Header Section -->
    <div class="mb-6 flex justify-between items-end border-b border-gray-100 pb-4">
        <div>
            <h2 class="text-xl font-bold text-gray-800 uppercase">वेबसाइट व्यवस्थापन निर्देशिका</h2>
            <p class="text-xs text-gray-500 uppercase tracking-widest">Annapurna Polytechnic Institute</p>
        </div>
        <div class="text-right">
            <span class="text-[10px] font-bold text-gray-400 uppercase block">User Manual</span>
            <span class="text-sm font-bold text-[#1d0647]">Full Guide v2.0</span>
        </div>
    </div>

    <!-- Quick Overview -->
    <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-4 mb-8 flex items-center gap-4">
        <div
            class="shrink-0 w-12 h-12 bg-white rounded-full flex items-center justify-center text-indigo-600 shadow-sm">
            <i class="fa-solid fa-circle-info text-xl"></i>
        </div>
        <div>
            <p class="text-xs font-bold text-indigo-800 uppercase tracking-tight">प्रणालीको बारेमा</p>
            <p class="text-[13px] text-indigo-700">यो म्यानुअलले ड्यासबोर्डबाट सामग्रीहरू (Content) थप्ने, हटाउने र
                परिमार्जन गर्ने विस्तृत प्रक्रिया बताउँछ।</p>
        </div>
    </div>

    <!-- Step-by-Step Guides -->
    <div class="space-y-8">

        <!-- Section 1: Principal Message -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-xs font-bold text-gray-600 uppercase flex items-center gap-2">
                    <i class="fa-solid fa-user-tie text-blue-600"></i> १. प्रिन्सिपलको सन्देश (Principal Message)
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <p class="text-xs font-bold text-gray-800">प्रक्रिया (Steps):</p>
                        <ul class="text-[13px] text-gray-600 space-y-3">
                            <li class="flex gap-2">
                                <span class="text-blue-600 font-bold">१.</span>
                                "Principle Message" मा गएर सन्देश टाइप गर्नुहोस्।
                            </li>
                            <li class="flex gap-2">
                                <span class="text-blue-600 font-bold">२.</span>
                                अक्षरहरूलाई बोल्ड (Bold) वा इटालिक (Italic) गर्न माथिको टुलबार प्रयोग गर्नुहोस्।
                            </li>
                            <li class="flex gap-2">
                                <span class="text-blue-600 font-bold">३.</span>
                                सबै सकिएपछि "Save Changes" बटनमा क्लिक गर्नुहोस्।
                            </li>
                        </ul>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                        <p class="text-[11px] font-bold text-blue-800 mb-2 uppercase">विशेष जानकारी:</p>
                        <p class="text-[12px] text-blue-700 leading-relaxed">
                            सन्देशमा प्रिन्सिपलको नाम र फोटो स्टाफ सेक्सन (Staff Section) बाट सिधै तानिन्छ। त्यसैले,
                            फोटो फेर्नु परेमा स्टाफ लिस्टमा गएर प्रिन्सिपलको विवरण सच्याउनुहोस्।
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Notice & Publication -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-xs font-bold text-gray-600 uppercase flex items-center gap-2">
                    <i class="fa-solid fa-bullhorn text-orange-600"></i> २. सूचना र प्रकाशन (Notice & Publication)
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-6">
                    <div>
                        <p class="text-xs font-bold text-gray-800 mb-3 border-l-4 border-orange-500 pl-2">नयाँ सूचना
                            थप्ने तरिका:</p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="border border-gray-100 p-3 rounded-lg text-center">
                                <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Step A</p>
                                <p class="text-[12px] font-medium text-gray-700">Category छान्नुहोस् (उदा: Result वा
                                    Exam)</p>
                            </div>
                            <div class="border border-gray-100 p-3 rounded-lg text-center">
                                <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Step B</p>
                                <p class="text-[12px] font-medium text-gray-700">PDF फाइल वा सूचनाको फोटो अपलोड
                                    गर्नुहोस्</p>
                            </div>
                            <div class="border border-gray-100 p-3 rounded-lg text-center">
                                <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Step C</p>
                                <p class="text-[12px] font-medium text-gray-700">नेपाली मिति र शीर्षक लेखेर Save
                                    गर्नुहोस्</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-900 rounded-lg p-4 text-white">
                        <p class="text-[11px] font-bold text-orange-400 uppercase mb-2">फरक बुझ्नुहोस्:</p>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-[12px] font-bold border-b border-gray-700 pb-1 mb-1 italic">Notice Board
                                </p>
                                <p class="text-[11px] text-gray-400">दैनिक समाचार, परीक्षा तालिका र नतिजाको लागि।</p>
                            </div>
                            <div>
                                <p class="text-[12px] font-bold border-b border-gray-700 pb-1 mb-1 italic">Publication
                                </p>
                                <p class="text-[11px] text-gray-400">नियम पुस्तिका, जर्नल र टेण्डर सूचनाहरूको लागि।</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3: Staff Management -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-xs font-bold text-gray-600 uppercase flex items-center gap-2">
                    <i class="fa-solid fa-users-gear text-purple-600"></i> ३. कर्मचारी व्यवस्थापन (Staff Management)
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-start gap-4">
                    <div
                        class="w-8 h-8 bg-purple-100 rounded text-purple-600 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-list-ol text-xs"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-800 uppercase">Hierarchy (क्रम) मिलाउने तरिका:</p>
                        <p class="text-[13px] text-gray-600 mt-1">वेबसाइटमा कर्मचारीको नाम तल-माथि देखाउन 'Drag & Drop'
                            फिचर प्रयोग गर्नुहोस्। माउसले नाम समातेर चाहिएको ठाउँमा तान्नुहोस्।</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div
                        class="w-8 h-8 bg-emerald-100 rounded text-emerald-600 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-camera text-xs"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-800 uppercase">फोटो साइज:</p>
                        <p class="text-[13px] text-gray-600 mt-1">कर्मचारीको फोटो अपलोड गर्दा 'Passport Size' को फोटो
                            राम्रो देखिन्छ।</p>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- Section: Short Term Program -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-xs font-bold text-gray-600 uppercase flex items-center gap-2">
                <i class="fa-solid fa-layer-group text-red-600"></i> ४. Short Term Program Management
            </h3>
        </div>

        <div class="p-6 space-y-6">

            <!-- Category Create -->
            Program Category (Sort Term) थप्ने तरिका:
            <div>
                <p class="text-xs font-bold text-gray-800 mb-2 border-l-4 border-red-500 pl-2">
                </p>

                <ul class="text-[13px] text-gray-600 space-y-2">
                    <li>१. Dashboard मा <b>"Sort Term Program"</b> मा जानुहोस्</li>
                    <li>२. सुरुमा <b>Main Categories</b> देखिन्छ</li>
                    <li>३. <b>"Add New"</b> मा क्लिक गर्नुहोस्</li>
                    <li>४. Category Name लेख्नुहोस् (उदा: Computer, Agriculture)</li>
                    <li>५. Save गर्नुहोस्</li>
                </ul>
            </div>

            <!-- Add Program -->
            <div>
                <p class="text-xs font-bold text-gray-800 mb-2 border-l-4 border-blue-500 pl-2">
                    नयाँ Short Term Program थप्ने तरिका:
                </p>

                <div class="grid md:grid-cols-2 gap-4">

                    <div class="bg-blue-50 border border-blue-100 p-4 rounded-lg">
                        <p class="text-[12px] font-semibold text-blue-800 mb-2">Form मा भर्ने विवरण:</p>
                        <ul class="text-[12px] text-blue-700 space-y-2">
                            <li>• Notice Title / Program Title लेख्नुहोस्</li>
                            <li>• Category छान्नुहोस् (अघिल्लो step मा बनाएको)</li>
                            <li>• Attachment अपलोड गर्नुहोस् (PDF वा Image)</li>
                            <li>• Content Details लेख्नुहोस्</li>
                        </ul>
                    </div>

                    <div class="bg-gray-50 border border-gray-100 p-4 rounded-lg">
                        <p class="text-[12px] font-semibold text-gray-800 mb-2">Final Step:</p>
                        <ul class="text-[12px] text-gray-600 space-y-2">
                            <li>• सबै जानकारी भरेपछि <b>Save</b> मा क्लिक गर्नुहोस्</li>
                            <li>• Program सफलतापूर्वक Add हुन्छ</li>
                        </ul>
                    </div>

                </div>
            </div>

            <!-- Manage -->
            <div>
                <p class="text-xs font-bold text-gray-800 mb-2 border-l-4 border-green-500 pl-2">
                    Program Manage गर्ने तरिका:
                </p>

                <ul class="text-[13px] text-gray-600 space-y-2">
                    <li>१. <b>"Manage All"</b> मा जानुहोस्</li>
                    <li>२. सबै Programs सूचीमा देखिन्छ</li>
                    <li>३. Edit गरेर Program परिवर्तन गर्न सकिन्छ</li>
                    <li>४. Delete गरेर हटाउन सकिन्छ</li>
                    <li>५. Category पनि Manage गर्न सकिन्छ</li>
                </ul>
            </div>

            <!-- Tips -->
            <div class="bg-red-50 border border-red-100 p-4 rounded-lg">
                <p class="text-[11px] font-bold text-red-700 mb-2 uppercase">महत्त्वपूर्ण सुझाव:</p>
                <ul class="text-[12px] text-red-600 space-y-1">
                    <li>• सही Category छान्नुहोस्</li>
                    <li>• PDF/Image साइज सानो राख्नुहोस्</li>
                    <li>• Title स्पष्ट राख्नुहोस्</li>
                </ul>
            </div>

        </div>
    </div>

    <!-- Content Body -->
    <div class="p-6 space-y-4">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-xs font-bold text-gray-600 uppercase flex items-center gap-2">
                <i class="fa-solid fa-layer-group text-red-600"></i> ५. ID Cards
            </h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Side: Steps -->
            <div class="space-y-3">
                <p class="text-xs font-bold text-gray-800"> (Steps to Create ID):</p>
                <ul class="text-[13px] text-gray-600 space-y-3">
                    <li class="flex gap-2">
                        <span class="text-blue-600 font-bold">१.</span>
                        मेनुमा रहेको <b>ID Cards</b> सेक्सन भित्रको <b>Create Section</b> मा जानुहोस्।
                    </li>
                    <li class="flex gap-2">
                        <span class="text-blue-600 font-bold">२.</span>
                        <b>Create Student ID Card</b> मा क्लिक गरी विद्यार्थीको नाम (Full Name), ब्याज (Batch), म्याद
                        सकिने मिति (Expire Date), मोबाइल नम्बर र ठेगाना भर्नुहोस्।
                    </li>
                    <li class="flex gap-2">
                        <span class="text-blue-600 font-bold">३.</span>
                        <b>Program</b> छनोट गर्दा 'Plant Science' वा 'Animal Science' मध्ये एक रोज्नुहोस्।
                    </li>
                    <li class="flex gap-2">
                        <span class="text-blue-600 font-bold">४.</span>
                        विद्यार्थीको पि.पि. साइजको फोटो (PP Size Photo) अपलोड गरी <b>Generate Record</b> मा क्लिक
                        गर्नुहोस्।
                    </li>
                </ul>
            </div>

            <!-- Right Side: Special Info / Manage Info -->
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                <p class="text-[11px] font-bold text-blue-800 mb-2 uppercase">व्यवस्थापन र परिमार्जन (Manage & Edit):
                </p>
                <p class="text-[12px] text-blue-700 leading-relaxed mb-3">
                    सिर्जना गरिएका सबै परिचय पत्रहरू हेर्न <b>Manage ID Card</b> सेक्सनमा जानुहोस्।
                </p>
                <ul class="text-[12px] text-blue-700 space-y-2">
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                        <b>Edit:</b> कुनै विवरण गलत भएमा सच्याउन सकिनेछ।
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-trash-can text-[10px]"></i>
                        <b>Delete:</b> आवश्यक नपरेमा रेकर्ड हटाउन सकिनेछ।
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-check-circle text-[10px]"></i>
                        डाटा सुरक्षित भएपछि तपाईंले सिधै प्रिन्ट गर्न सक्नुहुन्छ।
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Content Body -->
    <div class="p-6 space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Side: Steps -->
            <div class="space-y-3">
                <p class="text-xs font-bold text-gray-800">प्रमाणपत्र बनाउने प्रक्रिया (Steps to Generate):</p>
                <ul class="text-[13px] text-gray-600 space-y-3">
                    <li class="flex gap-2">
                        <span class="text-blue-600 font-bold">१.</span>
                        <b>Basic Information:</b> विद्यार्थीको नाम, बुबा-आमाको नाम, जन्म मिति र इस्यु नम्बर (Issue No)
                        भर्नुहोस्।
                    </li>
                    <li class="flex gap-2">
                        <span class="text-blue-600 font-bold">२.</span>
                        <b>Address Details:</b> प्रदेश (Province), जिल्ला, नगरपालिका/गाउँपालिका र वडा नम्बर छनोट
                        गर्नुहोस्।
                    </li>
                    <li class="flex gap-2">
                        <span class="text-blue-600 font-bold">३.</span>
                        <b>Academic Details:</b> कोर्स (Plant/Animal Science), CTEVT Reg No, भर्ना भएको र उत्तीर्ण भएको
                        साल (BS) सहीसँग भर्नुहोस्।
                    </li>
                    <li class="flex gap-2">
                        <span class="text-blue-600 font-bold">४.</span>
                        <b>Finalize:</b> डिभिजन र प्रतिशत (%) राखेर प्रमाणपत्र जारी गर्ने मिति (Issue Date) छान्नुहोस् र
                        रेकर्ड सेभ गर्नुहोस्।
                    </li>
                </ul>
            </div>

            <!-- Right Side: Important Notes -->
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                <p class="text-[11px] font-bold text-blue-800 mb-2 uppercase">ध्यान दिनुपर्ने कुराहरू:</p>
                <div class="space-y-3 text-[12px] text-blue-700 leading-relaxed">
                    <p>
                        <i class="fa-solid fa-circle-info text-[10px] mr-1"></i>
                        सबै मितिहरू <b>नेपाली (BS)</b> मा भर्नु अनिवार्य छ।
                    </p>
                    <p>
                        <i class="fa-solid fa-location-dot text-[10px] mr-1"></i>
                        ठेगाना छनोट गर्दा सात प्रदेशमध्ये विद्यार्थीको स्थायी ठेगाना भएको प्रदेश छनोट गर्नुहोस्।
                    </p>
                    <p>
                        <i class="fa-solid fa-print text-[10px] mr-1"></i>
                        रेकर्ड सेभ भएपछि "Manage Certificate" मा गएर सिधै प्रिन्ट प्रिभ्यु (Print Preview) हेर्न र
                        प्रिन्ट गर्न सकिन्छ।
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Body -->
    <div class="p-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Gallery & Video Section -->
            <div class="space-y-4">
                <div>
                    <p class="text-xs font-bold text-gray-800 mb-2 flex items-center gap-2">
                        <i class="fa-regular fa-image text-blue-500"></i> ग्यालरी र भिडियो (Gallery & Video):
                    </p>
                    <ul class="text-[13px] text-gray-600 space-y-2 ml-4">
                        <li class="list-disc"><b>Gallery:</b> कलेजका कार्यक्रमका फोटोहरू अपलोड गर्न "Add Image" प्रयोग
                            गर्नुहोस् र "Manage Gallery" बाट पुराना फोटो हटाउन वा फेर्न सकिन्छ।</li>
                        <li class="list-disc"><b>Video:</b> युट्युबको लिङ्क (Link) राखेर भिडियो थप्न "Add Video" मा
                            जानुहोस्।</li>
                    </ul>
                </div>

                <div>
                    <p class="text-xs font-bold text-gray-800 mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-blog text-blue-500"></i> ब्लग र पोस्ट (Blog Post):
                    </p>
                    <ul class="text-[13px] text-gray-600 space-y-2 ml-4">
                        <li class="list-disc"><b>Add New Post:</b> नयाँ समाचार वा लेख लेख्न शीर्षक, विवरण र कभर फोटो
                            राखेर पब्लिश गर्नुहोस्।</li>
                        <li class="list-disc"><b>Manage Posts:</b> यहाँबाट पुराना पोस्टहरू सम्पादन (Edit) वा हटाउन
                            (Delete) सकिन्छ।</li>
                    </ul>
                </div>
            </div>

            <!-- Resources & Management Note -->
            <div class="space-y-4">

                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <p class="text-[11px] font-bold text-gray-800 mb-2 uppercase">सामान्य नियम (Quick Guide):</p>
                    <ul class="text-[12px] text-gray-600 space-y-2">
                        <li class="flex items-start gap-2">
                            <span class="text-blue-600">•</span>
                            वेबसाइटको गति कायम राख्न फोटो अपलोड गर्दा कम साइज (Low size) को प्रयोग गर्नुहोस्।
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-blue-600">•</span>
                            भिडियो राख्दा युट्युबको <b>Embed Link</b> वा पूरा URL प्रयोग गर्नुहोस्।
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!-- Content Body -->
    <div class="p-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Steps -->
            <div class="space-y-3">
                <p class="text-xs font-bold text-gray-800">नोटिस र फाइल अपलोड प्रक्रिया:</p>
                <ul class="text-[13px] text-gray-600 space-y-3">
                    <li class="flex gap-2">
                        <span class="text-blue-600 font-bold">१.</span>
                        <b>Manage Resources:</b> यहाँबाट तपाईंले विद्यार्थीका लागि आवश्यक नोट, पाठ्यक्रम वा महत्वपूर्ण
                        सूचना अपलोड गर्न सक्नुहुन्छ।
                    </li>
                    <li class="flex gap-2">
                        <span class="text-blue-600 font-bold">२.</span>
                        <b>Auto-Popup:</b> तपाईंले यहाँ अपलोड गर्नुभएको मुख्य सूचना वेबसाइट खोल्ने बित्तिकै सुरुमा
                        <b>Popup Notification</b> को रूपमा देखिनेछ।
                    </li>
                    <li class="flex gap-2">
                        <span class="text-blue-600 font-bold">३.</span>
                        <b>Visibility:</b> यसले गर्दा प्रयोगकर्ता वा विद्यार्थीले वेबसाइट भित्र नपसी सिधै महत्वपूर्ण
                        जानकारी थाहा पाउन सक्छन्।
                    </li>
                </ul>
            </div>

            <!-- Preview/Visual Note -->
            <div class="space-y-4">
                <div class="bg-orange-50 p-4 rounded-lg border border-orange-100">
                    <p class="text-[11px] font-bold text-orange-800 mb-2 uppercase flex items-center gap-2">
                        <i class="fa-solid fa-eye"></i> पप-अप कस्तो देखिन्छ? (Preview):
                    </p>
                    <a href="{{ asset('assets/img/popup.png') }}" target="_blank"
                        class="mt-2 border-2 border-dashed border-orange-200 rounded p-2 bg-white flex flex-col items-center hover:bg-orange-50 hover:border-orange-400 transition-all cursor-pointer group">
                        <!-- Image Preview -->
                        <img src="{{ asset('assets/img/popup.png') }}" alt="Popup Preview"
                            class="h-20 opacity-75 grayscale mb-2 group-hover:grayscale-0 group-hover:opacity-100 transition-all">

                        <!-- Text Label -->
                        <p class="text-[10px] text-orange-600 text-center italic flex items-center gap-1">
                            <i class="fa-solid fa-magnifying-glass-plus text-[8px]"></i>
                            वेबसाइट खुल्दा देखिने नमुना (popup.png)
                        </p>
                    </a>
                </div>

                <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                    <p class="text-[11px] font-bold text-blue-800 mb-2 uppercase">प्राविधिक जानकारी:</p>
                    <p class="text-[12px] text-blue-700 leading-relaxed">
                        अपलोड गर्दा फाइलको नाम स्पष्ट राख्नुहोस्। यदि तपाईं इमेज (Image) अपलोड गर्दै हुनुहुन्छ भने, त्यो
                        पप-अपमा स्पष्ट देखिने गरी मिलाउनुहोस्। पुरानो पप-अप हटाउन वा फेर्न <b>Manage Resources</b> बाटै
                        डिलिट वा अपडेट गर्न सकिन्छ।
                    </p>
                </div>
            </div>

        </div>
    </div>

    <!-- Content Body -->
<div class="p-6 space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Left Side: Steps -->
        <div class="space-y-3">
            <p class="text-xs font-bold text-gray-800">नयाँ एडमिन दर्ता गर्ने प्रक्रिया (Admin Registration):</p>
            <ul class="text-[13px] text-gray-600 space-y-3">
                <li class="flex gap-2">
                    <span class="text-blue-600 font-bold">१.</span>
                    <b>Admin Users</b> सेक्सनमा गएर नयाँ एडमिनको पूरा नाम (Full Name) र इमेल (Email) भर्नुहोस्।
                </li>
                <li class="flex gap-2">
                    <span class="text-blue-600 font-bold">२.</span>
                    <b>Assign Role:</b> उक्त प्रयोगकर्तालाई कुन तहको जिम्मेवारी दिने हो (जस्तै: Super Admin वा Manager) सो छनोट गर्नुहोस्।
                </li>
                <li class="flex gap-2">
                    <span class="text-blue-600 font-bold">३.</span>
                    <b>Default Password:</b> लगइनका लागि एउटा अस्थायी पासवर्ड सेट गर्नुहोस्।
                </li>
                <li class="flex gap-2">
                    <span class="text-blue-600 font-bold">४.</span>
                    सबै विवरण भरेर सेभ गरेपछि उक्त एडमिनको इमेलमा लगइन जानकारी स्वचालित रूपमा पठाइनेछ।
                </li>
            </ul>
        </div>

        <!-- Right Side: Email Notification Info -->
        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
            <p class="text-[11px] font-bold text-blue-800 mb-2 uppercase flex items-center gap-2">
                <i class="fa-solid fa-envelope"></i> इमेल जानकारी (Email Notification):
            </p>
            <p class="text-[12px] text-blue-700 leading-relaxed mb-3">
                दर्ता भएपछि नयाँ एडमिनले आफ्नो इमेलमा निम्न अनुसारको सन्देश प्राप्त गर्नेछन्:
            </p>
            <div class="bg-white p-3 rounded border border-blue-200 text-[11px] text-gray-700 italic">
                "नमस्ते [Admin Name], तपाईंलाई यस सिस्टमको एडमिन प्यानलमा पहुँच दिइएको छ। तपाईंको लगइन इमेल र अस्थायी पासवर्ड तल दिइएको छ..."
            </div>
            <p class="text-[11px] text-blue-600 mt-3 font-bold">
                <i class="fa-solid fa-circle-exclamation mr-1"></i> नोट: सुरक्षाको लागि, पहिलो पटक लगइन गरेपछि पासवर्ड परिवर्तन गर्न सुझाव दिनुहोला।
            </p>
        </div>
    </div>
</div>
    <!-- General Maintenance Tips -->
    <div class="mt-8 bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
        <div class="px-6 py-4 bg-emerald-600 text-white">
            <h4 class="text-xs font-bold uppercase tracking-wider">विशेष सावधानीहरू (Tips)</h4>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex gap-3">
                <i class="fa-solid fa-circle-check text-emerald-500 mt-1"></i>
                <p class="text-[12px] text-gray-700 font-medium">कुनै पनि सामग्री थपेपछि वेबसाइटको 'Live View' मा गएर एक
                    पटक चेक गर्नुहोस्।</p>
            </div>
            <div class="flex gap-3">
                <i class="fa-solid fa-circle-check text-emerald-500 mt-1"></i>
                <p class="text-[12px] text-gray-700 font-medium">धेरै ठूलो फाइल (उदा: 10MB भन्दा ठूलो) अपलोड नगर्नुहोस्,
                    यसले वेबसाइट ढिलो बनाउँछ।</p>
            </div>
            <div class="flex gap-3">
                <i class="fa-solid fa-circle-check text-emerald-500 mt-1"></i>
                <p class="text-[12px] text-gray-700 font-medium">पासवर्ड नियमित रूपमा परिवर्तन गर्नुहोस् र कसैलाई पनि
                    नदिनुहोस्।</p>
            </div>
            <div class="flex gap-3">
                <i class="fa-solid fa-circle-check text-emerald-500 mt-1"></i>
                <p class="text-[12px] text-gray-700 font-medium">काम सकिएपछि सधैं 'Logout' गर्ने बानी बसाल्नुहोस्।</p>
            </div>
        </div>
    </div>

    <!-- Managed Support Footer -->
    <div class="mt-6 p-6 bg-gray-900 rounded-xl text-white shadow-lg border-l-4 border-orange-500">
        <div class="flex items-center gap-5">
            <div class="shrink-0 text-center">
                <p class="text-[10px] font-bold text-gray-500 uppercase mb-1">Help Desk</p>
                <i class="fa-solid fa-headset text-orange-400 text-3xl"></i>
            </div>
            <div class="border-l border-gray-700 pl-5">
                <p class="text-sm font-medium leading-relaxed text-gray-300">
                    यदि तपाईँलाई प्रणाली चलाउन कुनै थप सहयोग चाहिएमा वा पासवर्ड बिर्सिएमा प्राविधिक टिमलाई सम्पर्क
                    गर्नुहोस्।
                </p>
                <div class="mt-3 flex gap-4">
                    <span class="text-[11px] font-bold text-orange-500">EMAIL: gaihrenirmal2021@institute.com</span>
                    <span class="text-[11px] font-bold text-orange-500">CALL: +977-9765511650</span>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-8 pb-8 text-gray-400">
        <p class="text-[10px] font-bold uppercase tracking-[0.2em]">© {{ date('Y') }} All Rights Reserved</p>
    </div>
</div>
@endsection