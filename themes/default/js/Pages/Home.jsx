import {usePage} from "@inertiajs/react";
import Toast, {createToast} from "../Components/Toast.jsx";
import {Layout} from "lucide-react";
import ShopLayout from "../Layouts/ShopLayout.jsx";
import {Button} from "@heroui/react";

function Home() {
    const props = usePage().props;
    console.log(props);

    return (
        <>
            <div className="h-screen">
                <button onClick={() => createToast({
                    id: Math.random().toString(36).substring(2, 9),
                    title: "Hello",
                    message: "This is a toast message",
                    variant: "info",
                    timeout: 3000,
                    dismissible: true
                })}>
                    Open info toast
                </button>

                <button onClick={() => createToast({
                    id: Math.random().toString(36).substring(2, 9),
                    title: "Hello",
                    message: "This is a toast message",
                    variant: "success",
                    timeout: 3000,
                    dismissible: true
                })}>
                    Open success toast
                </button>

                <button onClick={() => createToast({
                    id: Math.random().toString(36).substring(2, 9),
                    title: "Hello",
                    message: "This is a toast message",
                    variant: "error",
                    timeout: 3000,
                    dismissible: true
                })}>
                    Open error toast
                </button>

                <button onClick={() => createToast({
                    id: Math.random().toString(36).substring(2, 9),
                    title: "Hello",
                    message: "This is a toast message",
                    variant: "warning",
                    timeout: 3000,
                    dismissible: true
                })}>
                    Open warning toast
                </button>

                <div>
                    asas
                </div>

                <Button>
                    asas
                </Button>
            </div>
        </>
    );
}

Home.layout = page => <ShopLayout children={page} title="Home" />

export default Home;
