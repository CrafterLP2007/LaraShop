export default function MustVerifyEmail() {
    return (
        <div className="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 via-white to-blue-200">
            <div className="bg-white shadow-xl rounded-2xl p-10 max-w-md w-full text-center border border-blue-100">
                <div className="flex items-center justify-center mb-6">
                    <span className="inline-flex items-center justify-center h-20 w-20 rounded-full bg-blue-50">
                        <svg className="h-12 w-12 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M16 12V8a4 4 0 10-8 0v4M12 16v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </div>
                <h1 className="text-3xl font-extrabold mb-3 text-blue-700">Verify your email address</h1>
                <p className="mb-8 text-gray-600 leading-relaxed">
                    We sent a verification link to your email.<br />
                    Please check your inbox.<br />
                    Didn&#39;t get the email? Request a new one below.
                </p>
                <button
                    type="button"
                    className="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow transition"
                >
                    Resend Verification Email
                </button>
            </div>
        </div>
    );
}
