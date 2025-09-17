import './bootstrap';
import {createInertiaApp} from "@inertiajs/react";
import {createRoot} from "react-dom/client";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${appName} - ${title}`,
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.jsx', {eager: true});
        return pages[`./Pages/${name}.jsx`];
    },
    setup({el, App, props}) {
        const root = createRoot(el);
        root.render(
            <main className="text-foreground bg-background">
                <App {...props} />
            </main>
        );
    },
    progress: {
        color: '#338EF7',
    },
}).then(_ =>
    console.log("Inertia app initialized")
);
