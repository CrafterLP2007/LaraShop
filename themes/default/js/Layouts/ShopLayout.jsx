import ShopNavbar from "../Components/Navbar/ShopNavbar.jsx";
import Toast from "../Components/Toast.jsx";

export default function ShopLayout({children, title}) {
    return (
        <div className="h-screen">
            <Toast />
            <ShopNavbar />
            <main className="max-w-7xl mx-auto px-4 py-6 overflow-y-auto flex-1">
                {children}
            </main>
        </div>
    );
}
