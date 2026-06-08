@extends('layouts.header')

@section('title', 'BAFAI - Faculty & Advisory Board')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/faculty.css') }}">
@endpush

@section('content')
<!-- Breadcrumb -->
@include('layouts.breadcrumb', ['title' => 'Our Faculty & Advisory Board', 'breadcrumb' => 'Faculty'])

<!-- Core Faculty Section -->
<section class="faculty-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>Core Faculty</h2>
            <p>Meet the visionary leaders driving BAFAI's mission</p>
        </div>

        <!-- Dr. Lola Olukuewu -->
        <div class="faculty-row" data-aos="fade-up" data-aos-delay="100">
            <div class="faculty-image">
                <img src="{{ asset('assets/img/faculty/lola-olukuewu.jpeg') }}" alt="Dr. Lola Olukuewu">
            </div>
            <div class="faculty-content">
                <h3>Dr. Lola Olukuewu</h3>
                <div class="title">Founder, BAFAI</div>
                <div class="bio">
                    Dr. Lola is an AI entrepreneur, investor, author, and international speaker with over 20 years of experience in hospitality, real estate, and technology. An MIT-trained expert in No-Code AI and Machine Learning, she made history as the first Nigerian female certified Chief AI Officer by the Copenhagen Institute for Technology. Passionate about growth and development in developing nations, she now mentors career-changers, professionals, entrepreneurs, and leaders through BAFAI, and drives global impact by bridging the knowledge and skill gaps in AI. Dr. Lola co-founded Aivira, creators of the AI-powered call center system, Ordibl, and is the Founder/CEO of TOPAS Hub, one of Africa’s most eco-friendly tech hubs. She also leads several ventures across diverse industries and is widely recognised for her leadership in AI safety, governance, and education.
                </div>
                <a href="https://www.linkedin.com/in/dr-lola-olukuewu-05325b79?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base_contact_details%3BtPO6pM4xTc69lLzoXb1LzQ%3D%3D" class="btn-linkedin" target="_blank"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
                <img src="{{ asset('assets/img/cropped-BAFAI-ICON-180x180.png') }}" class="logo-watermark" alt="BAFAI">
            </div>
        </div>

        <!-- Professor Krishna Mohan -->
        <div class="faculty-row" data-aos="fade-up" data-aos-delay="150">
            <div class="faculty-image">
                <img src="{{ asset('assets/img/faculty/krishna-mohan.jpeg') }}" alt="Professor Krishna Mohan">
            </div>
            <div class="faculty-content">
                <h3>Professor Krishna Mohan</h3>
                <div class="title">Professor of Practice in Business Analytics</div>
                <div class="bio">
                    Professor Krishna Mohan is a Technology and Data Science leader with over two decades of global experience spanning software engineering, AI/ML, cloud computing, and healthcare data strategy. Having held senior leadership positions at Clarivate and Thomson Reuters, he has built high-performing teams and delivered enterprise-grade cloud-native platforms across digital transformation projects in the US, Europe, Asia, and the Middle East. His expertise encompasses Data Governance, Generative AI, Master Data Management, and Analytics Systems Deployment across healthcare, life sciences, and legal technology sectors. Currently serving as Professor of Practice in Business Analytics at T.A. Pai Management Institute, he mentors professionals through programmes affiliated with MIT, Johns Hopkins, and UT Austin. He is passionate about helping aspiring leaders understand and apply AI and big data analytics in practical, ethical, and innovative ways, connecting classroom learning with real-world impact.
                </div>
                <a href="#" class="btn-linkedin" target="_blank"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
                <img src="{{ asset('assets/img/cropped-BAFAI-ICON-180x180.png') }}" class="logo-watermark" alt="BAFAI">
            </div>
        </div>
    </div>
</section>

<!-- Guest Facilitators Section -->
<section class="faculty-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>Guest Facilitators</h2>
            <p>Industry experts sharing real-world insights</p>
        </div>

        <!-- Tolu Falola -->
        <div class="faculty-row" data-aos="fade-up" data-aos-delay="100">
            <div class="faculty-image">
                <img src="{{ asset('assets/img/faculty/tolu-falola.jpeg') }}" alt="Tolu Falola">
            </div>
            <div class="faculty-content">
                <h3>Tolu Falola</h3>
                <div class="title">Global Energy Expert & AI Safety Advocate</div>
                <div class="bio">Tolu is a global energy expert with 17+ years of experience across Africa and Europe in power systems, utilities, digital energy, and clean tech. She holds an MBA from the University of Dundee and multiple global certifications, including Energy Manager (IEE USA), Green Banking (RENAC), Solar Energy (ECT UK), and is a Fellow of IIMC Nigeria. She is a leading voice and coach in the Energy sector in Africa and Europe, and is an emerging AI safety advocate.</div>
                <a href="#" class="btn-linkedin" target="_blank"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
                <img src="{{ asset('assets/img/cropped-BAFAI-ICON-180x180.png') }}" class="logo-watermark" alt="BAFAI">
            </div>
        </div>

        <!-- Winifred Amase -->
        <div class="faculty-row" data-aos="fade-up" data-aos-delay="150">
            <div class="faculty-image">
                <img src="{{ asset('assets/img/faculty/winifred-amase.jpg') }}" alt="Winifred Amase">
             </div>
            <div class="faculty-content">
                <h3>Winifred Amase</h3>
                <div class="title">Data Storytelling Designer</div>
                <div class="bio">Winifred is a data storytelling designer with a strong editorial eye and a passion for clarity. She has worked on design projects across fintech, media, education, and other impact-driven sectors — always focused on transforming complex information into clear, engaging visuals. Her infographics have been featured on global platforms like Visual Capitalist and CoinGecko, and she’s known for crafting human-centered visuals that make data both insightful and accessible. She also shares her creative process on YouTube, helping others understand the art behind infographic storytelling.</div>
                <a href="#" class="btn-linkedin" target="_blank"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
                <img src="{{ asset('assets/img/cropped-BAFAI-ICON-180x180.png') }}" class="logo-watermark" alt="BAFAI">
            </div>
        </div>

        <!-- Wole Abegunde -->
        <div class="faculty-row" data-aos="fade-up" data-aos-delay="200">
            <div class="faculty-image">
                <img src="{{ asset('assets/img/faculty/wole-abegunde.jpeg') }}" alt="Wole Abegunde">
            </div>
            <div class="faculty-content">
                <h3>Wole Abegunde</h3>
                <div class="title">Market Research & Strategy Consultant</div>
                <div class="bio">He is the “Sherlock Holmes” of African tech market insights, with about two decades experience delivering market research, consumer insights, and strategy consulting projects for MTN Group, Airtel Africa, Vodacom, Safaricom, Telkom Kenya, Dimension Data, Microsoft, AWS, Google, Huawei, Ericsson etc. across sub-Saharan Africa.</div>
                <a href="#" class="btn-linkedin" target="_blank"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
                <img src="{{ asset('assets/img/cropped-BAFAI-ICON-180x180.png') }}" class="logo-watermark" alt="BAFAI">
            </div>
        </div>

        <!-- Oluwole Olaku -->
        <div class="faculty-row" data-aos="fade-up" data-aos-delay="250">
            <div class="faculty-image">
                <img src="{{ asset('assets/img/faculty/oluwole-olaku.jpeg') }}" alt="Oluwole Olaku">
            </div>
            <div class="faculty-content">
                <h3>Oluwole Olaku</h3>
                <div class="title">Certified Agilist & Tech Enthusiast</div>
                <div class="bio">Oluwole Olaku is a Certified Agilist and a generalist tech enthusiast with extensive experience across Healthcare, finance, tech and non-tech domains.</div>
                <a href="#" class="btn-linkedin" target="_blank"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
                <img src="{{ asset('assets/img/cropped-BAFAI-ICON-180x180.png') }}" class="logo-watermark" alt="BAFAI">
            </div>
        </div>

        <!-- Ayuba -->
        <div class="faculty-row" data-aos="fade-up" data-aos-delay="300">
            <div class="faculty-image">
                <img src="{{ asset('assets/img/faculty/ayuba.jpeg') }}" alt="Ayuba">
            </div>
            <div class="faculty-content">
                <h3>Ayuba</h3>
                <div class="title">PhD Researcher, NLP & CEO of Active Tech</div>
                <div class="bio">I am a PhD Researcher at the University of Manchester, where my work is at the forefront of Natural Language Processing (NLP). My primary mission is to expand the linguistic horizons of Artificial Intelligence, specifically by improving AI’s capability to understand and process African languages. By bridging these communication gaps, I aim to ensure that the future of AI is globally inclusive and accessible. My academic endeavor is rooted in a first-class degree in computer science, which I acquired from ABU Zaria. Beyond research, I am the CEO of Active Tech, a tech consultancy that specializes in software engineering and AI automation for small to medium-sized businesses. I am passionate about taking complex problems and turning them into practical, scalable solutions—whether that is through my consultancy work or building AI-powered platforms like Traders College. I have a personal commitment towards empowering Africans to meetup with the rapidly evolving AI space – as a matter of emergency.</div>
                <a href="#" class="btn-linkedin" target="_blank"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
                <img src="{{ asset('assets/img/cropped-BAFAI-ICON-180x180.png') }}" class="logo-watermark" alt="BAFAI">
            </div>
        </div>
    </div>
</section>

<!-- Advisory Board Section -->
<section class="faculty-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>Advisory Board</h2>
            <p>Guiding BAFAI's strategic direction and global impact</p>
        </div>

        <!-- Dr. Anuradha Rao -->
        <div class="faculty-row" data-aos="fade-up" data-aos-delay="100">
            <div class="faculty-image">
                <img src="{{ asset('assets/img/faculty/anuradha-rao.jpeg') }}" alt="Dr. Anuradha Rao">
            </div>
            <div class="faculty-content">
                <h3>Dr. Anuradha Rao</h3>
                <div class="title">CEO, PANFISH Solutions & L&D Expert</div>
                <div class="bio">Anuradha comes with more than 3 decades of experience in the space of Education and Learning & Development. She is currently the CEO of PANFISH Solutions Pvt Ltd, a UNIORG company in India that provides SAP implementation, development, and support services. She is also the Director in LeAD Solutions and has a proven track record of delivering impactful L&D solutions across levels and geographies, having worked with leading organisations such as GE, IBM, MphasiS, Genpact, and Deutsche Bank and educational institutes (Visiting Faculty at Centre for Organisation Development and as Dean of Annapurna College of Film and Media). She is a certified L&D professional, Coach, and Counsellor. She has been certified by ISB (Indian School of Business) in Leadership with AI. Anuradha has been a prolific writer since 1992 and has many publications to her credit, mostly in education and teacher development.</div>
                <a href="#" class="btn-linkedin" target="_blank"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
                <img src="{{ asset('assets/img/cropped-BAFAI-ICON-180x180.png') }}" class="logo-watermark" alt="BAFAI">
            </div>
        </div>

        <!-- Clara Blackings -->
        <div class="faculty-row" data-aos="fade-up" data-aos-delay="150">
            <div class="faculty-image">
                <img src="{{ asset('assets/img/faculty/clara-blackings.jpg') }}" alt="Clara Blackings">
            </div>
            <div class="faculty-content">
                <h3>Clara Blackings</h3>
                <div class="title">Higher Education & Programme Management Specialist, Oxford Saïd</div>
                <div class="bio">Clara Blackings is a higher education and programme management specialist with expertise in executive education, stakeholder engagement, and inclusive learning. At Saïd Business School, University of Oxford, she designs and delivers executive programmes for global leaders—overseeing planning, faculty coordination, and participant experience. With a background spanning healthcare, creative arts, and cultural sectors, Clara has led work across widening participation, marketing, and engagement. Her strengths lie in building meaningful relationships, managing complex projects, and creating energising learning environments. She holds a BA in Music Broadcasting and is passionate about the power of media and creative technology to drive social good. Clara is also an advocate for mental health, accessible education for women, and lifelong learning.</div>
                <a href="#" class="btn-linkedin" target="_blank"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
                <img src="{{ asset('assets/img/cropped-BAFAI-ICON-180x180.png') }}" class="logo-watermark" alt="BAFAI">
            </div>
        </div>

        <!-- Andrea A. Jacobs -->
        <div class="faculty-row" data-aos="fade-up" data-aos-delay="200">
            <div class="faculty-image">
                <img src="{{ asset('assets/img/faculty/andrea-jacobs.jpg') }}" alt="Andrea A. Jacobs">
            </div>
            <div class="faculty-content">
                <h3>Andrea A. Jacobs</h3>
                <div class="title">AI Governance & Policy Legal Expert</div>
                <div class="bio">Andrea A. Jacobs is a distinguished legal professional with over 13 years of experience at the intersection of law, finance, and emerging technology. She holds an LL.M. in Banking and Finance from Queen Mary University of London and an LL.M. in Environment and Energy Law from Georgetown University Law Center, offering a rare blend of expertise across regulatory, financial, and environmental domains. Today, she stands as a leading voice and sought-after speaker from the Global South on AI governance, equity, and inclusion. She advises companies and institutions navigating the evolving regulatory landscape of artificial intelligence, including compliance with the EU AI Act and alignment with the General-Purpose AI Code of Practice. Through her legal expertise and policy insight, she is helping shape how AI is developed and deployed responsibly, with a particular focus on the needs and voices of countries within the Global South.</div>
                <a href="#" class="btn-linkedin" target="_blank"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
                <img src="{{ asset('assets/img/cropped-BAFAI-ICON-180x180.png') }}" class="logo-watermark" alt="BAFAI">
            </div>
        </div>

        <!-- Dr. Curtis B. Charles -->
        <div class="faculty-row" data-aos="fade-up" data-aos-delay="250">
            <div class="faculty-image">
                <img src="{{ asset('assets/img/faculty/curtis-charles.jpeg') }}" alt="Dr. Curtis B. Charles">
            </div>
            <div class="faculty-content">
                <h3>Dr. Curtis B. Charles</h3>
                <div class="title">Founder & CEO, FutureLogic AI Consulting Group</div>
                <div class="bio">An MIT- and Harvard-trained strategist, Dr. Curtis B. Charles is the Founder and CEO of FutureLogic AI Consulting Group, where he leads AI-driven transformation across governments, institutions, and mission-driven organizations. From AI-powered public sector reform to education innovation and digital governance, FutureLogic delivers bold, actionable solutions tailored for emerging economies. Its signature offerings—forecast-based finance modeling, AI policy reform, and future-of-work readiness—operate at the intersection of strategy, technology, and social equity. Dr. Charles and his team advise leaders navigating disruption, build capacity in underserved regions, and craft scalable, ethical frameworks that move nations forward. This isn’t theory. It’s a transformation in motion.</div>
                <a href="#" class="btn-linkedin" target="_blank"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
                <img src="{{ asset('assets/img/cropped-BAFAI-ICON-180x180.png') }}" class="logo-watermark" alt="BAFAI">
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 100,
        easing: 'ease-out-quad'
    });
</script>
@endpush