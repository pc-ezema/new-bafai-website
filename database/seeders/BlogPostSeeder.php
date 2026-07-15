<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $posts = [
            [
                'title' => 'From the Global South to the Global Stage: How BAFAI Is Bridging Skill Gaps in AI',
                'content' => <<<HTML
<p>Despite being home to more than 85% of the world's projected population growth by 2050, areas like sub-Saharan Africa, South Asia, and Latin America continue to face deep-rooted underinvestment in tech infrastructure, education, and workforce readiness. Shockingly, less than 1% of global AI research originates from Africa, according to UNESCO. McKinsey warns that by 2030, over 375 million workers, most in emerging markets, will be forced to change careers without the tools or training to do so.</p>

<p>In response to this urgent need, Bloom Academy for Artificial Intelligence (BAFAI) is set to launch as one of the first dedicated AI academies in the Global South. Positioned as a catalyst for equipping many to tackle AI roles, and close the unemployment gaps for developing nations globally, BAFAI aims to democratise access to world-class AI education, reduce the rate at which AI will cause job losses to the unskilled, and train for ethical innovation in individuals and organisations across Africa, and the broader Global South.</p>

<p>The upcoming launch represents a bold statement of intent: the evolving present and future of AI will not be imported perpetually, it will be built locally, ethically, and deliberately. Speaking ahead of the launch in July 2025, BAFAI's founder and lead visionary, Dr. Lola Olukuewu, highlighted the academy's mission to empower the next generation of global AI leaders, starting from the Global South.</p>

<p>"For so long, the Global South has faced layered challenges at the table where the future is being designed. With BAFAI, we are helping to change that narrative. We are not just teaching AI, we are enabling many to think, learn, and create in a manner that is consistent with the unprecedented pace in which the world is changing. We are more of a social cause than a business venture, seeing that we have created this great social impact door that lets in anyone who is serious about creating a pathway for themselves, with exposure to MIT-standard type of education, at a tiny fraction of the cost. Our courses are taught by very seasoned professionals, and we have the honour of getting the involvement of senior industry experts, to share practical experiences with the learners. We also have Mentorship Sessions in the more intensive modules, and also teach soft skills to further boost our learners' chances in this highly competitive professional space. We made sure we built in so much value for a stipend, so that many people can have a low barrier to entry into elite standards, mindsets, and strategies to stay ahead with Artificial Intelligence.</p>

<p>Post-study, our outstanding learners will be integrated with our recruitment partners. This will give them strong possibilities of being matched with international roles, starting from internship roles, and upwards. We would also enable our outstanding learners who wish to start their own businesses by providing sustained subscriptions to AI tools and platforms, which they would need to launch and scale their new ventures." she said.</p>

<p>BAFAI's programs are structured around three core pillars: Profitable AI education, Sustainable Career Upskilling, and Practical Reorientation for success in any chosen role with AI. At launch, the academy will roll out its flagship tracks— Track 1 is the Certificate in AI Fundamentals (CAIF), and Track 2 is the Certificate in AI Task Management (CAITM). The Track 1 (CAIF) is a free, self-paced but proctored course for beginners and professionals, who see (as we do), the pressing need to educate themselves about AI. This 2-day foundational course offers an introduction to artificial intelligence, machine learning, data science, and basic exposure to real-world applications of AI across key sectors such as tech, healthcare, education, agriculture, finance, energy, logistics, and many more.</p>

<p>The CAIF course also provides a clear view of global and local career pathways in AI, serving as a springboard for further deeper, technical, and industry-specific learning. For learners ready to further their knowledge journey as a progression on the foundational Track 1, BAFAI will offer a 6-week Certificate in AI Task Management (CAITM) course. This is a project-based intermediate certification that combines live sessions, on-demand videos, and mentoring. This Track 2 course has 8 modules which include generative AI, prompt engineering, data science, new AI roles, etc. It also breaks down practical use of AI tools across several fields. Track 2 is enriched with real-world case studies, live study sessions, and on-demand video interviews with professionals currently using AI across various industries. The program will be available at a heavily discounted fee of $50, and with scholarship possibilities for specific cases. Our learners will be assessed across topics taught, along with submission of projects, in order to earn their certificates.</p>

<p>"Our aim is to remove financial, geographic, and psychological barriers. By offering high-impact education that is flexible and affordable, we're opening the doors of AI to everyone—students, entrepreneurs, professionals, and career changers alike."</p>

<p>In addition to online learning, BAFAI plans to host periodic community workshops and meetups in select regions, to deepen engagement and provide learners with opportunities for collaboration, feedback, and local impact.</p>

<p>The vision behind BAFAI is rooted not only in innovation but in social transformation. With AI increasingly defining global competitiveness and economic direction, BAFAI is positioning the Global South, not as a follower, but as a leader.</p>

<p>Known as Dr. Lola, BAFAI founder is the a Certified Chief AI Officer, MIT-trained AI and Machine Learning professional, and an AI Serial Entrepreneur, with over two decades of multi-industry experience in business. She has consulted in different capacities for global tech giants including Google, Meta, and Amazon. She added that: "Artificial intelligence belongs on the list of critical technologies shaping our world. But if it's going to serve everyone, then everyone must have the chance to shape it. At BAFAI, we are training builders, not just users. Visionaries, not just consumers."</p>

<p><strong>About BAFAI</strong><br>
Bloom Academy for Artificial Intelligence (BAFAI) is one of Africa's AI-focused educational platforms. Rooted in accessibility, ethics, and social impact, BAFAI is on a mission to democratise AI learning for individuals and organisations across the Global South—equipping them to compete, lead, and transform their communities through technology.</p>
HTML,
                'author' => 'BAFAI',
                'published_at' => Carbon::parse('2025-07-20'),
                'is_published' => true,
                'views' => 0,
                'featured_image' => 'BAFAI-1024x726.png',
            ],
            [
                'title' => '5 Surprising Careers You Can Start with AI (Even If You Can’t Code)',
                'content' => <<<HTML
<p>When most people think about AI careers, they picture programmers and data scientists. But here's what's actually happening: the most in-demand AI jobs today have nothing to do with coding.</p>

<p>Last month, a marketing manager I know landed a six-figure role as an AI Art Director. She doesn't write code. What she has is the ability to understand how to generate the right AI prompt that produces the right result per generation.</p>

<p>At BAFAI, we believe that safe and beneficial use of AI is for everyone, and many of the most exciting AI career opportunities today do not require a background in coding or data science.</p>

<p>Across the globe, new job titles are emerging at the intersection of AI and traditional careers. Your existing expertise isn't something to overcome, it's your competitive edge. Marketers who understand AI create deeper customer connections. Educators become invaluable in helping organizations adopt AI tools. Finance, healthcare, and legal professionals ensure AI works within real-world constraints.</p>

<p>The learning involved isn't a years-long computer science degree. Most successful AI professionals started with basic literacy: understanding what AI can and can't do, learning to work with AI tools effectively, and developing confidence to experiment.</p>

<p>For example, companies are hiring AI Product Managers to shape how AI tools are used in real life. These roles require creativity, strategic thinking, and the ability to translate user needs into AI-powered solutions, not coding expertise. There is also a booming space for AI Ethicists, who ensure that AI systems are designed and deployed responsibly. As AI begins to influence decisions in finance, healthcare, education, and government, the importance of ethical oversight cannot be overstated.</p>

<p>Another fast-rising job is that of the Prompt Engineers – people who craft the right words to get the most effective outputs from AI systems like ChatGPT, Gemini, Meta AI, Midjourney, or DALL·E. It is part creativity, part psychology, and part experimentation. Similarly, AI Trainers help improve machine learning systems by feeding them human-curated data and feedback. These positions demand attention to detail and critical thinking more than technical skills.</p>

<p>And the best part? You can start learning all of this today without a tech degree.</p>

<p>BAFAI's Track 1 program introduces you to the world of AI in a simple, structured way, with no prior experience needed. You will explore how AI works, where it's going, and how you can be part of the movement. If you're ready to shift your career, upgrade your knowledge, or just understand what is really happening with this technology, we're here to guide you.</p>

<p><strong>Start learning today with BAFAI.</strong> Register at <a href="https://www.bafai.ai">www.bafai.ai</a></p>
HTML,
                'author' => 'BAFAI',
                'published_at' => Carbon::parse('2025-08-12'),
                'is_published' => true,
                'views' => 0,
                'featured_image' => '9-1024x726.png',
            ],
            [
                'title' => 'How Artificial Intelligence can Multiply your Income',
                'content' => <<<HTML
<p>You're working three different gigs, posting content at midnight, and still barely keeping up with demand. Sound familiar?</p>

<p>Here's the reality: talent isn't the problem. Time is. And that's exactly where AI becomes your secret weapon.</p>

<h2>Why you need an upgrade</h2>

<p>In places like Lagos, Nairobi, or Cape Town, the side hustle isn't optional, it's how you survive and thrive. But while talent is abundant, time and tools are limited.</p>

<p>But what if you could be more productive in half the time? What if you could predict what your customers want before they know it themselves? What if your one person operation could compete with entire teams?</p>

<p>Here's how people are actually using AI to multiply their income:</p>

<ul>
    <li><strong>Content creators</strong> are using AI to generate weeks of social media posts in one afternoon, then spending their freed-up time landing bigger clients.</li>
    <li><strong>Fashion entrepreneurs</strong> are using AI to spot trending styles and colors months ahead, giving them a massive competitive edge in sourcing and design.</li>
    <li><strong>Freelance writers</strong> are using AI for research and first drafts, allowing them to take on three times more projects without burning out.</li>
    <li><strong>Small business owners</strong> are using AI chatbots to handle customer inquiries 24/7, capturing sales even while they sleep.</li>
</ul>

<p>Here's what happens when you master AI tools:</p>

<p>Your capacity explodes while your workload stays manageable. That graphic design project that used to take 6 hours? Now it takes 2. That market research that ate up your weekend? Done in 30 minutes.</p>

<p>Suddenly, you're not choosing between quality and quantity, you're delivering both. You're not trading time for money, you're building systems that work while you focus on growth.</p>

<h2>Your Next Move</h2>

<p>At Bloom Academy For AI, we've built our programs specifically for you.</p>

<p><strong>Certificate in AI Fundamentals (Track 1)</strong> gets you started with the purpose of AI literacy and competency in the history, purposes, trends, and opportunities in A.I.</p>

<p><strong>Certificate in AI Task Manager (Track 2)</strong> This Certification equips you with the ability to tackle targeted projects that require integration of AI tools and technology into projects and systems, at foundational and intermediate levels.</p>

<p><strong>Ready to stop working harder and start working smarter?</strong></p>

<p>Get started with Track 1, completely free at <a href="https://bafai.ai/caif/">https://bafai.ai/caif/</a></p>
HTML,
                'author' => 'BAFAI',
                'published_at' => Carbon::parse('2025-08-12'),
                'is_published' => true,
                'views' => 0,
                'featured_image' => '4-1024x726.png',
            ],
            [
                'title' => 'Why You Can\'t Wait to Catch Up With AI',
                'content' => <<<HTML
<p>AI is transforming everything but without access and upskilling, a new form of inequality is brewing. AI is expected to create 20-50 million new jobs by 2030 according to a report by McKinsey and Company. Now imagine most of them going to countries and communities with early access to AI tools, education, and infrastructure. What happens to the rest of the communities that lack the access?</p>

<p>This is the silent crisis unfolding across many parts of Africa and the developing world. Without intervention, AI won't just widen the digital divide, it'll deepen economic and opportunity gaps. We stand the risk of having a generation of job-ready youths but for jobs they were never trained for, creating a costly wave of educators and workers whose skills are years behind the future that has already arrived.</p>

<p><strong>Bloom Academy For AI (BAFAI) was created to interrupt this brewing tragedy:</strong></p>

<p>Our vision is simple: Make AI literacy and skills affordable, accessible, and applicable. Our Track 1 courses open the door to AI introduction/foundational modules, while Track 2 takes you into real world applications of AI tools and readiness to be gainfully upskilled. BAFAI gives you the ability to tackle targeted projects that require integration of AI tools and technology, at foundational and intermediate levels.</p>

<p><strong>The Global South doesn't only need to catch up, it needs to gainfully benefit at the global table.</strong></p>

<p>Register at <a href="https://bafai.ai/our-courses/">https://bafai.ai/our-courses/</a> to get started!</p>
HTML,
                'author' => 'BAFAI',
                'published_at' => Carbon::parse('2025-08-12'),
                'is_published' => true,
                'views' => 0,
                'featured_image' => '6-1024x726.png',
            ],
            [
                'title' => 'Active Tech Communications and BAFAI Partner to Enhance AI Learning and Career Opportunities',
                'content' => <<<HTML
<p>As demand for AI-related skills continues to grow, education alone is no longer enough. Learners increasingly need opportunities to apply their knowledge, gain practical exposure, and connect with the industries they hope to serve.</p>

<p>To support this goal, Bloom Academy for Artificial Intelligence (BAFAI) is pleased to announce a partnership with Active Tech Communications focused on strengthening AI learning, industry engagement, and professional development opportunities for learners across Africa.</p>

<h2>Moving Beyond Learning Alone</h2>

<p>Across many emerging technology fields, one of the biggest challenges learners face is not gaining knowledge but gaining exposure.</p>

<p>Many individuals complete courses and certifications but struggle to find opportunities to apply what they have learned in practical environments. Bridging this gap requires stronger connections between education, industry, and workforce development.</p>

<p>The cooperation between BAFAI and Active Tech Communications contributes to this effort by creating a broader support ecosystem around the learner journey.</p>

<p>While BAFAI focuses on delivering practical AI education, Active Tech Communications brings experience supporting technology talent development, professional growth initiatives, and industry engagement activities. Together, both organizations aim to create a more connected pathway between learning and opportunity.</p>

<h2>Building Workforce Readiness for an AI-Driven Economy</h2>

<p>Employers are looking for more than theoretical knowledge as AI becomes increasingly integrated into business operations, research, customer experience, cybersecurity, communications, and decision-making processes.</p>

<p>They are looking for individuals who can understand real-world challenges, adapt quickly, collaborate effectively, and apply technology within professional environments. This requires a combination of technical understanding, practical application, and professional development.</p>

<p>By supporting activities that connect learners with practical experiences and professional opportunities, the partnership seeks to help learners build confidence and readiness for the evolving world of work.</p>

<h2>Strengthening Long-Term Talent Development</h2>

<p>The future of Africa's digital economy will depend not only on access to education but also on the systems that help talented individuals develop sustainable careers.</p>

<p>Creating these systems requires synergy between educators, industry leaders, employers, and organizations committed to workforce development. The relationship between BAFAI and Active Tech Communications reflects this broader objective.</p>

<p>By supporting learner development through training initiatives, industry engagement, and opportunities for professional growth, both organizations are contributing to a stronger pipeline of AI-ready talent across Africa.</p>

<h2>Creating Stronger Pathways for Future AI Talent</h2>

<p>The opportunities created by Artificial Intelligence continue to expand across industries and sectors. Preparing people to participate meaningfully in this future requires more than teaching technology. It requires helping learners build the confidence, experience, and professional exposure needed to apply their skills in real-world contexts.</p>

<p>As BAFAI continues to expand its programmes and learner community, targeted joint efforts such as this will play an important role in helping learners move beyond knowledge acquisition and toward practical participation in the digital economy.</p>

<p>For more information about BAFAI programmes and learning opportunities, visit <a href="https://bafai.ai">https://bafai.ai</a></p>
HTML,
                'author' => 'BAFAI',
                'published_at' => Carbon::parse('2026-06-17'),
                'is_published' => true,
                'views' => 0,
                'featured_image' => 'BAFAI-X-Active-Tech-Partnership.jpg',
            ],
            [
                'title' => 'Building Smarter Energy Futures: How BAFAI and RenewCap Are Advancing AI in Renewable Energy',
                'content' => <<<HTML
<p>The future of Africa's energy sector will not be shaped by infrastructure alone. It will also be shaped by the people who know how to harness Artificial Intelligence to solve complex challenges, improve operational efficiency, and accelerate innovation.</p>

<p>That is why Bloom Academy for Artificial Intelligence (BAFAI) is pleased to begin working with RenewCap to explore how AI capability can strengthen Africa's growing renewable energy ecosystem.</p>

<h2>Bringing AI and Renewable Energy Together</h2>

<p>As a clean energy financing company, RenewCap is helping businesses and households overcome one of the biggest barriers to renewable energy adoption&mdash;access to affordable financing. By making clean energy solutions more accessible, RenewCap is contributing to a more sustainable and resilient future.</p>

<p>BAFAI shares a complementary mission. Our focus is preparing Africa's workforce with practical AI skills that can be applied across industries, enabling professionals and organisations to work smarter, make better decisions, and build systems that are ready for the future.</p>

<p>This collaboration creates an opportunity to bring those two missions together.</p>

<h2>Empowering Organisations with Practical AI Skills</h2>

<p>By combining RenewCap's work within the renewable energy sector with BAFAI's expertise in practical AI education, both organisations will explore ways to equip founders, professionals, and businesses with the knowledge to integrate AI into everyday operations and decision-making.</p>

<p>Beyond learning how to use AI tools, the emphasis is on helping organisations build AI-enabled systems that improve productivity, streamline workflows, and support sustainable growth.</p>

<p>This aligns closely with BAFAI's Practical AI Framework for SMEs, which focuses on building business clarity first before introducing AI into real operational workflows.</p>

<h2>Preparing Africa for the Energy Transition</h2>

<p>As Africa continues its transition towards cleaner energy, developing AI capability alongside renewable infrastructure will become increasingly important.</p>

<p>This collaboration reflects a shared belief that sustainable development depends not only on technology, but also on empowering people with the skills to use it effectively.</p>

<h2>Building a Future-Ready Workforce</h2>

<p>Together, BAFAI and RenewCap are contributing to building a workforce that is ready for both the energy transition and the AI economy.</p>

<p>Through practical AI education and industry collaboration, both organisations aim to support businesses, professionals, and innovators in adopting intelligent solutions that drive productivity, sustainability, and long-term economic growth across Africa.</p>

<p>For more information about BAFAI programmes and learning opportunities, visit <a href="https://bafai.ai">https://bafai.ai</a></p>
HTML,
                'author' => 'BAFAI',
                'published_at' => Carbon::parse('2026-07-17'),
                'is_published' => true,
                'views' => 0,
                'featured_image' => 'BAFAI-X-RenewCap-blog.jpg',
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::updateOrCreate(
                ['slug' => Str::slug($post['title'])],
                $post
            );
        }
    }
}