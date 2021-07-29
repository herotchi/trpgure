<style>
    ol li.brackets {
        list-style-type: none;
        counter-increment: cnt;
        position: relative;
        padding-left: 15px;
    }

    ol li.brackets::before {
        content: "("counter(cnt)")";
        text-align: right;
        position: absolute;
        top: 0;
        left: -20px;
    }
</style>
<h2>{{ config('app.name') }}プライバシーポリシー</h2>

<p>【へろっちしまうま～ず】（以下「当サークル」といいます。）は、当社の提供するサービス（以下「本サービス」といいます。）における、ユーザーについての個人情報を含む利用者情報の取扱いについて、以下のとおりプライバシーポリシー（以下「本ポリシー」といいます。）を定めます。</p>

<h4>1. 収集する利用者情報及び収集方法</h4>
<p>本ポリシーにおいて、「利用者情報」とは、ユーザーの識別に係る情報、通信サービス上の行動履歴、その他ユーザーまたはユーザーの端末に関連して生成または蓄積された情報であって、本ポリシーに基づき当サークルが収集するものを意味するものとします。本サービスにおいて当サークルが収集する利用者情報は、その収集方法に応じて、以下のようなものとなります。</p>
<ol>
    <li class="brackets">ユーザーからご提供いただく情報
        <p>本サービスを利用するために、または本サービスの利用を通じてユーザーからご提供いただく情報は以下のとおりです。</p>
        <ul>
            <li>入力フォームその他当サークルが定める方法を通じてユーザーが入力または送信する情報</li>
        </ul>
    </li>
    <li class="brackets">ユーザーが本サービスを利用するにあたって、当サークルが収集する情報
        <p>当サークルは、本サービスへのアクセス状況やそのご利用方法に関する情報を収集することがあります。これには以下の情報が含まれます。</p>
        <ul>
            <li>リファラ</li>
            <li>IPアドレス</li>
            <li>サーバーアクセスログに関する情報</li>
            <li>Cookie、ADID、IDFAその他の識別子</li>
        </ul>
    </li>
</ol>
<h4>2. 利用目的</h4>
<p>本サービスのサービス提供にかかわる利用者情報の具体的な利用目的は以下のとおりです。</p>
<ol>
    <li class="brackets">本サービスに関する登録の受付、本人確認、ユーザー認証、ユーザー設定等本サービスの提供、維持、保護及び改善のため</li>
    <li class="brackets">ユーザーのトラフィック測定及び行動測定のため</li>
    <li class="brackets">広告の配信、表示及び効果測定のため</li>
    <li class="brackets">本サービスに関するご案内、お問い合わせ等への対応のため</li>
    <li class="brackets">本サービスに関する当サークルの規約、ポリシー等（以下「規約等」といいます。）に違反する行為に対する対応のため</li>
    <li class="brackets">本サービスに関する規約等の変更などを通知するため</li>
</ol>
<h4>3. 通知・公表または同意取得の方法、利用中止要請の方法</h4>
<p>ユーザーは、本サービスの所定の設定を行うことにより、利用者情報の全部または一部についてその収集又は利用の停止を求めることができ、この場合、当サークルは速やかに、当サークルの定めるところに従い、その利用を停止します。なお利用者情報の項目によっては、その収集または利用が本サービスの前提となるため、当サークル所定の方法により本サービスを退会した場合に限り、当サークルはその収集又は利用を停止します。</p>
<h4>4. 外部送信、第三者提供、情報収集モジュールの有無</h4>
<ol>
    <li>本サービスでは同サービスの利用状況を把握するためにGoogle Analyticsを利用し、Google Analyticsから提供されるCookieを使用しています。Google Analyticsによって個人を特定する情報は取得していません。</li>
    <li>Google Analytics の利用により収集されたデータは、Google社のプライバシーポリシーに基づいて管理されています。Google Analyticsの利用規約・プライバシーポリシーについてはGoogle Analytics のホームページでご確認ください。
        <br>
        <a href="https://marketingplatform.google.com/about/analytics/terms/jp/" target="_blank" rel="noopener noreferrer">Google アナリティクス サービス利用規約@include('layouts.blank')</a>
        <br>
        <a href="https://policies.google.com/" target="_blank" rel="noopener noreferrer">Google ポリシーと規約@include('layouts.blank')</a>
    </li>
</ol>
<h4>5. 第三者提供</h4>
<p>当サークルは、利用者情報のうち、個人情報については、あらかじめユーザーの同意を得ないで、第三者（日本国外にある者を含みます。）に提供しません。但し、次に掲げる必要があり第三者（日本国外にある者を含みます。）に提供する場合はこの限りではありません。</p>
<ol>
    <li class="brackets">当サークルが利用目的の達成に必要な範囲内において個人情報の取扱いの全部または一部を委託する場合</li>
    <li class="brackets">合併その他の事由による事業の承継に伴って個人情報が提供される場合</li>
    <li class="brackets">第4項の定めに従って、提携先または情報収集モジュール提供者へ個人情報が提供される場合</li>
    <li class="brackets">国の機関もしくは地方公共団体またはその委託を受けた者が法令の定める事務を遂行することに対して協力する必要がある場合であって、ユーザーの同意を得ることによって当該事務の遂行に支障を及ぼすおそれがある場合</li>
    <li class="brackets">その他、個人情報の保護に関する法律（以下「個人情報保護法」といいます。）その他の法令で認められる場合</li>
</ol>
<h4>6. 共同利用</h4>
<p>該当事項はありません。</p>
<h4>7. 個人情報の開示</h4>
<p>当サークルは、ユーザーから、個人情報保護法の定めに基づき個人情報の開示を求められたときは、ユーザーご本人からのご請求であることを確認の上で、ユーザーに対し、遅滞なく開示を行います（当該個人情報が存在しないときにはその旨を通知いたします。）。但し、個人情報保護法その他の法令により、当サークルが開示の義務を負わない場合は、この限りではありません。なお、個人情報の開示につきましては、手数料（1件あたり1,000円）を頂戴しておりますので、あらかじめ御了承ください。</p>
<h4>8. 個人情報の訂正及び利用停止等</h4>
<ol>
    <li>当サークルは、ユーザーから、(1)個人情報が真実でないという理由によって個人情報保護法の定めに基づきその内容の訂正を求められた場合、及び(2)あらかじめ公表された利用目的の範囲を超えて取扱われているという理由または偽りその他不正の手段により収集されたものであるという理由により、個人情報保護法の定めに基づきその利用の停止を求められた場合には、ユーザーご本人からのご請求であることを確認の上で遅滞なく必要な調査を行い、その結果に基づき、個人情報の内容の訂正または利用停止を行い、その旨をユーザーに通知します。なお、訂正または利用停止を行わない旨の決定をしたときは、ユーザーに対しその旨を通知いたします。</li>
    <li>当サークルは、ユーザーから、ユーザーの個人情報について消去を求められた場合、当サークルが当該請求に応じる必要があると判断した場合は、ユーザーご本人からのご請求であることを確認の上で、個人情報の消去を行い、その旨をユーザーに通知します。</li>
    <li>個人情報保護法その他の法令により、当サークルが訂正等または利用停止等の義務を負わない場合は、8-1および8-2の規定は適用されません。</li>
</ol>
<h4>9. お問い合わせ窓口</h4>
<p>ご意見、ご質問、苦情のお申出その他利用者情報の取扱いに関するお問い合わせは、下記の窓口までお願いいたします。
    <br>
    <a href="https://twitter.com/herotchi" target="_blank" rel="noopener noreferrer">へろっちシマウマ～ずのTwitter @include('layouts.blank')</a>
</p>
<h4>10. プライバシーポリシーの変更手続</h4>
<p>当サークルは、必要に応じて、本ポリシーを変更します。但し、法令上ユーザーの同意が必要となるような本ポリシーの変更を行う場合、変更後の本ポリシーは、当サークル所定の方法で変更に同意したユーザーに対してのみ適用されるものとします。なお、当サークルは、本ポリシーを変更する場合には、変更後の本ポリシーの施行時期及び内容を当サークルのウェブサイト上での表示その他の適切な方法により周知し、またはユーザーに通知します。</p>
<p>【2021年7月18日制定】</p>
<p class="tR">以上</p>