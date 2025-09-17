import { useEffect } from "react";
import { usePage } from "@inertiajs/react";
import { toast, Toaster } from "sonner";
import { CheckCircle2, XCircle, AlertTriangle, Info } from "lucide-react";

const TOAST_VARIANTS = {
    success: {
        icon: (
            <span className="rounded-full bg-green-100 p-1 text-green-600">
                <CheckCircle2 className="w-5 h-5" aria-hidden="true" />
            </span>
        ),
        styles: "border border-green-300"
    },
    error: {
        icon: (
            <span className="rounded-full bg-red-100 p-1 text-red-600">
                <XCircle className="w-5 h-5" aria-hidden="true" />
            </span>
        ),
        styles: "border border-red-300"
    },
    warning: {
        icon: (
            <span className="rounded-full bg-yellow-100 p-1 text-yellow-600">
                <AlertTriangle className="w-5 h-5" aria-hidden="true" />
            </span>
        ),
        styles: "border border-yellow-300"
    },
    primary: {
        icon: (
            <span className="rounded-full bg-blue-100 p-1 text-blue-600">
                <Info className="w-5 h-5" aria-hidden="true" />
            </span>
        ),
        styles: "border border-blue-300"
    }
};

const ToastContent = ({ id, title, message, variant, onDismiss }) => {
    const icon = TOAST_VARIANTS[variant]?.icon || TOAST_VARIANTS.primary.icon;
    const classes = TOAST_VARIANTS[variant]?.styles || TOAST_VARIANTS.primary.styles;

    return (
        <div className={`pointer-events-auto relative rounded-xl shadow-xl min-w-[320px] max-w-[400px] p-4 transition-all flex items-center gap-2.5 bg-white ${classes}`}>
            {icon}
            <div className="flex flex-col gap-1 flex-1">
                {title && (
                    <h3 className={`text-sm font-semibold ${variant === "success" ? "text-green-700" : variant === "error" ? "text-red-700" : variant === "warning" ? "text-yellow-700" : "text-blue-700"}`}>
                        {title}
                    </h3>
                )}
                {message && <p className="text-pretty text-sm">{message}</p>}
            </div>
            <button
                type="button"
                className="ml-auto rounded-full p-1 hover:bg-neutral-200 transition cursor-pointer"
                aria-label="dismiss notification"
                onClick={() => {
                    toast.dismiss(id);
                    if (onDismiss) onDismiss();
                }}
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" strokeWidth={2} className="w-5 h-5 shrink-0 text-neutral-500" aria-hidden="true">
                    <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    );
};

const createToast = ({ id, title, message, variant = "primary", timeout = 5000, dismissible = true }) => {
    toast.custom((t) => (
        <ToastContent
            id={id}
            title={title}
            message={message}
            variant={variant}
            onDismiss={() => toast.dismiss(id)}
        />
    ), {
        id,
        duration: timeout,
        dismissible,
    });
};

const Toast = () => {
    const { flash } = usePage().props;

    useEffect(() => {
        const handleToasts = (toasts) => {
            toasts.forEach(createToast);
        };

        if (flash?.toasts?.length) {
            const existingToasts = JSON.parse(sessionStorage.getItem('toasts') || '[]');
            sessionStorage.setItem('toasts', JSON.stringify([...existingToasts, ...flash.toasts]));
            handleToasts(flash.toasts);
        } else {
            const savedToasts = JSON.parse(sessionStorage.getItem('toasts') || '[]');
            if (savedToasts.length) {
                handleToasts(savedToasts);
                sessionStorage.removeItem('toasts');
            }
        }
    }, [flash]);

    return <Toaster position="bottom-center" richColors />;
};

export { createToast };
export default Toast;
