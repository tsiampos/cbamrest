# Nokia CBAM (CloudBand Application Manager) REST Client

This tool is a GUI made for Windows and Openstack
In Windows you will just need to execute the setup.exe file and launch installation.

For Openstack, you can just transfer the qcow2 on the controller and upload image in glance. Then from dashboard, launch an instance in network with externally routable IP addresses (e.g management network) and use m1.small flavor. Once the VM is deployed, then go to http://<CBAM_REST_Client_IP>
Moreover, you will need to login web console of the VM as cbam/tigris or root/tigris and edit /etc/network/interfaces

Add the correct eth0 configuration based on the network/mask you have deployed:

auto eth0
iface eth0 inet static
address 10.0.0.6
netmask 255.255.255.0
network 10.0.0.0
gateway 10.0.0.1

Concerning usage of this tool:
1. Get CBAM token by completing the CBAM IP, client id and client secret fields.

2. Now in case you want to scale VNF then you will need to click on 'Scale VNF'. Access token and CBAM IP will be automatically populated after executing step 1. You will need here to define aspect id, VNF Id, number of steps, scale direction and additional parameters.
